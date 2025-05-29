@extends('layouts.doctor-dashboard')

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">Edit Appointment</h2>
        <a href="{{ route('doctor.appointments.index') }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-2"></i> Back to Appointments
        </a>
    </div>

    <div class="card-section">
        <form method="POST" action="{{ route('doctor.appointments.update', $appointment->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="pet_name" class="form-label">Pet Name</label>
                        <input type="text" name="pet_name" class="form-control" required
                            value="{{ $appointment->pet_name }}"
                            placeholder="Enter pet name">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="pet_type" class="form-label">Pet Type</label>
                        <select name="pet_type" class="form-control" required>
                            <option value="">-- Select Pet Type --</option>
                            <option value="dog" {{ $appointment->pet_type == 'dog' ? 'selected' : '' }}>Dog</option>
                            <option value="cat" {{ $appointment->pet_type == 'cat' ? 'selected' : '' }}>Cat</option>
                            <option value="bird" {{ $appointment->pet_type == 'bird' ? 'selected' : '' }}>Bird</option>
                            <option value="rabbit" {{ $appointment->pet_type == 'rabbit' ? 'selected' : '' }}>Rabbit</option>
                            <option value="hamster" {{ $appointment->pet_type == 'hamster' ? 'selected' : '' }}>Hamster</option>
                            <option value="other" {{ $appointment->pet_type == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="service" class="form-label">Service</label>
                        <select name="service" class="form-control" required>
                            <option value="">-- Select Service --</option>
                            <option value="consultation" {{ $appointment->service == 'consultation' ? 'selected' : '' }}>Consultation</option>
                            <option value="vaccination" {{ $appointment->service == 'vaccination' ? 'selected' : '' }}>Vaccination</option>
                            <option value="grooming" {{ $appointment->service == 'grooming' ? 'selected' : '' }}>Grooming</option>
                            <option value="deworming" {{ $appointment->service == 'deworming' ? 'selected' : '' }}>Deworming</option>
                            <option value="laboratory" {{ $appointment->service == 'laboratory' ? 'selected' : '' }}>Laboratory Test</option>
                            <option value="surgery" {{ $appointment->service == 'surgery' ? 'selected' : '' }}>Surgery</option>
                            <option value="dental" {{ $appointment->service == 'dental' ? 'selected' : '' }}>Dental Care</option>
                            <option value="emergency" {{ $appointment->service == 'emergency' ? 'selected' : '' }}>Emergency Care</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="doctor_id" class="form-label">Doctor</label>
                        <select name="doctor_id" class="form-control" required>
                            <option value="">-- Select Doctor --</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" 
                                    {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                    Dr. {{ $doctor->firstname }} {{ $doctor->lastname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="appointment_date" class="form-label">Date</label>
                        <input type="date" name="appointment_date" class="form-control" required
                            value="{{ $appointment->appointment_date }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="appointment_time" class="form-label">Time</label>
                        <input type="time" name="appointment_time" class="form-control" required
                            value="{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}">
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="notes" class="form-label">Notes</label>
                <textarea name="notes" class="form-control" rows="3" 
                    placeholder="Any special instructions or notes">{{ $appointment->notes }}</textarea>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="reset" class="btn btn-light me-3">
                    <i class="fas fa-redo me-2"></i> Reset Changes
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Update Appointment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection