<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
     public function index()
    {
        $appointments = Appointment::where('doctor_id', Auth::id())->get();
        return view('doctor.appointments.index', compact('appointments'));
    }

    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('doctor.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment status updated.');
    }
    public function create()
    {
        // Get doctors for selection if needed
        $doctors = User::where('role', 'doctor')->get();

        return view('doctor.appointments.create', compact('doctors'));
    }
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $doctors = User::where('role', 'doctor')->get();
        
        return view('doctor.appointments.edit', compact('appointment', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pet_name' => 'required|string|max:255',
            'pet_type' => 'required|string|max:255',
            'service' => 'required|in:consultation,vaccination,grooming,deworming,laboratory,surgery,dental,emergency',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'doctor_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $appointment = Appointment::findOrFail($id);
        
        $appointment->update([
            'doctor_id' => $request->doctor_id,
            'pet_name' => $request->pet_name,
            'pet_type' => $request->pet_type,
            'service' => $request->service,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('doctor.appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'pet_name' => 'required|string|max:255',
            'pet_type' => 'required|string|max:255',
            'service' => 'required|in:consultation,vaccination,grooming,deworming,laboratory,surgery,dental,emergency',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'doctor_id' => 'required|exists:users,id',
            'notes' => 'nullable|string',
        ]);

        Appointment::create([
            'user_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'pet_name' => $request->pet_name,
            'pet_type' => $request->pet_type,
            'service' => $request->service,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('doctor.appointments.index')->with('success', 'Appointment created successfully.');
    }
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('doctor.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}
