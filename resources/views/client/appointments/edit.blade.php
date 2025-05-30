<!-- resources/views/client/appointments/create.blade.php -->
@extends('layouts.client-dashboard')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0">{{ isset($appointment) ? 'Edit' : 'Create' }} Appointment</h3>
    </div>
    
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ isset($appointment) ? route('client.appointments.update', $appointment->id) : route('client.appointments.store') }}">
            @csrf
            @if(isset($appointment)) @method('PUT') @endif
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Pet Name *</label>
                    <input type="text" name="pet_name" class="form-control" value="{{ old('pet_name', $appointment->pet_name ?? '') }}" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">Pet Type *</label>
                    <input type="text" name="pet_type" class="form-control" value="{{ old('pet_type', $appointment->pet_type ?? '') }}" required>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Service *</label>
                    <select name="service" class="form-select" required>
                        <option value="">Select Service</option>
                        <option value="consultation" @selected(old('service', $appointment->service ?? '') == 'consultation')>Consultation</option>
                        <option value="vaccination" @selected(old('service', $appointment->service ?? '') == 'vaccination')>Vaccination</option>
                        <option value="grooming" @selected(old('service', $appointment->service ?? '') == 'grooming')>Grooming</option>
                        <option value="deworming" @selected(old('service', $appointment->service ?? '') == 'deworming')>Deworming</option>
                        <option value="laboratory test" @selected(old('service', $appointment->service ?? '') == 'laboratory test')>Laboratory Test</option>
                        <option value="surgery" @selected(old('service', $appointment->service ?? '') == 'surgery')>Surgery</option>
                        <option value="dental care" @selected(old('service', $appointment->service ?? '') == 'dental care')>Dental Care</option>
                        <option value="emergency care" @selected(old('service', $appointment->service ?? '') == 'emergency care')>Emergency Care</option>
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">Doctor *</label>
                    <select name="doctor_id" class="form-select" required>
                        <option value="">Select Doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" 
                                @selected(old('doctor_id', $appointment->doctor_id ?? '') == $doctor->id)>
                                Dr. {{ $doctor->firstname }} {{ $doctor->lastname }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Appointment Date *</label>
                    <input type="date" name="appointment_date" 
                        class="form-control" 
                        value="{{ old('appointment_date', $appointment->appointment_date ?? '') }}" 
                        min="{{ date('Y-m-d') }}" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">Appointment Time *</label>
                    <input type="time" name="appointment_time" 
                        class="form-control" 
                        value="{{ old('appointment_time', $appointment->appointment_time ?? '') }}" 
                        required>
                    <small class="text-muted">Format: HH:MM (24-hour format)</small>
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('client.appointments.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-times me-1"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Save Appointment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection