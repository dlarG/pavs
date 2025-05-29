<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
{
    // Always use Carbon for proper date handling
    $defaultStart = now()->subDays(6)->startOfDay();
    $defaultEnd = now()->endOfDay();

    if ($request->ajax() || $request->isMethod('post')) {
        $type = $request->report_type ?? 'appointment';
        $start = $request->start_date 
            ? Carbon::parse($request->start_date)->startOfDay() 
            : $defaultStart;
        $end = $request->end_date 
            ? Carbon::parse($request->end_date)->endOfDay() 
            : $defaultEnd;

        // Handle staff report
        if ($type === 'staff') {
            $data = User::where('role', 'staff')
                ->whereBetween('created_at', [$start, $end])
                ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            return response()->json([
                'labels' => $data->pluck('date'),
                'values' => $data->pluck('total'),
                'label' => 'New Staff Added by Day'
            ]);
        } 
        // Handle appointment report
        else {
            $data = Appointment::whereBetween('created_at', [$start, $end])
                ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            return response()->json([
                'labels' => $data->pluck('date'),
                'values' => $data->pluck('total'),
                'label' => 'Appointments by Day'
            ]);
        }
    }

    // Default GET request processing
    $appointments = Appointment::whereBetween('created_at', [$defaultStart, $defaultEnd])
        ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $data = [
        'dates' => $appointments->pluck('date')->toArray(),
        'totals' => $appointments->pluck('total')->toArray(),
    ];

    return view('doctor.reports.index', compact('data'));
}
    public function exportPDF(\Barryvdh\DomPDF\PDF $pdf)
    {
        $appointments = Appointment::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $pdf = $pdf->loadView('doctor.reports.pdf', compact('appointments'));
        return $pdf->download('appointments_report.pdf');
    }
}
