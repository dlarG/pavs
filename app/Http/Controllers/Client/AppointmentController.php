<?php

// app/Http/Controllers/Client/AppointmentController.php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'asc')
            ->get();
            
        return view('client.appointments.index', compact('appointments'));
    }

    public function create()
    {
        // Get available doctors
        $doctors = User::where('role', 'doctor')->get();
        
        return view('client.appointments.create', compact('doctors'));
    }

    public function store(Request $request)
{
    $request->validate([
        'pet_name' => 'required|string|max:255',
        'pet_type' => 'required|string|max:255',
        'service' => 'required|in:consultation,vaccination,grooming,deworming,laboratory test,surgery,dental care,emergency care',
        'appointment_date' => 'required|date|after_or_equal:today',
        'appointment_time' => 'required|date_format:H:i',
        'doctor_id' => 'required|exists:users,id',
    ]);

    // Check for existing appointments at same date/time
    $existingAppointment = Appointment::where('appointment_date', $request->appointment_date)
        ->where('appointment_time', $request->appointment_time)
        ->where('doctor_id', $request->doctor_id)
        ->exists();

    if ($existingAppointment) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['appointment_time' => 'The selected time slot is already booked. Please choose another time.']);
    }

    Appointment::create([
        'user_id' => Auth::id(),
        'doctor_id' => $request->doctor_id,
        'pet_name' => $request->pet_name,
        'pet_type' => $request->pet_type,
        'service' => $request->service,
        'appointment_date' => $request->appointment_date,
        'appointment_time' => $request->appointment_time,
        'status' => 'pending',
    ]);

    return redirect()->route('client.appointments.index')
        ->with('success', 'Appointment created successfully!');
}

    public function show($id)
    {
        $appointment = Appointment::where('user_id', Auth::id())
            ->findOrFail($id);
            
        return view('client.appointments.show', compact('appointment'));
    }

    public function edit($id)
    {
        $appointment = Appointment::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);
            
        $doctors = User::where('role', 'doctor')->get();
        
        return view('client.appointments.edit', compact('appointment', 'doctors'));
    }

    public function update(Request $request, $id)
{
    $appointment = Appointment::where('user_id', Auth::id())
        ->where('status', 'pending')
        ->findOrFail($id);
        
    $request->validate([
        'pet_name' => 'required|string|max:255',
        'pet_type' => 'required|string|max:255',
        'service' => 'required|in:consultation,vaccination,grooming,deworming,laboratory test,surgery,dental care,emergency care',
        'appointment_date' => 'required|date|after_or_equal:today',
        'appointment_time' => 'required|date_format:H:i',
        'doctor_id' => 'required|exists:users,id',
    ]);

    // Check for existing appointments at same date/time excluding current appointment
    $existingAppointment = Appointment::where('appointment_date', $request->appointment_date)
        ->where('appointment_time', $request->appointment_time)
        ->where('doctor_id', $request->doctor_id)
        ->where('id', '!=', $id)
        ->exists();

    if ($existingAppointment) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['appointment_time' => 'The selected time slot is already booked. Please choose another time.']);
    }

    $appointment->update([
        'doctor_id' => $request->doctor_id,
        'pet_name' => $request->pet_name,
        'pet_type' => $request->pet_type,
        'service' => $request->service,
        'appointment_date' => $request->appointment_date,
        'appointment_time' => $request->appointment_time,
    ]);

    return redirect()->route('client.appointments.index')
        ->with('success', 'Appointment updated successfully!');
}

    public function destroy($id)
    {
        $appointment = Appointment::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);
            
        $appointment->delete();
        
        return redirect()->route('client.appointments.index')
            ->with('success', 'Appointment cancelled successfully!');
    }

    public function getAvailableTimes(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'doctor_id' => 'required|exists:users,id'
        ]);

        // Define clinic working hours (8:00 AM to 5:00 PM)
        $startTime = Carbon::createFromTime(8, 0, 0);
        $endTime = Carbon::createFromTime(17, 0, 0);
        $interval = 30; // minutes

        // Get all booked appointments for this date and doctor
        $bookedAppointments = Appointment::where('appointment_date', $request->date)
            ->where('doctor_id', $request->doctor_id)
            ->pluck('appointment_time')
            ->toArray();

        // Generate all possible time slots
        $timeSlots = [];
        $currentTime = $startTime->copy();

        while ($currentTime <= $endTime) {
            $timeFormatted = $currentTime->format('H:i');
            
            // Check if time slot is available
            if (!in_array($timeFormatted, $bookedAppointments)) {
                $timeSlots[] = [
                    'time' => $timeFormatted,
                    'formatted' => $currentTime->format('g:i A')
                ];
            }
            
            $currentTime->addMinutes($interval);
        }

        return response()->json($timeSlots);
    }
}