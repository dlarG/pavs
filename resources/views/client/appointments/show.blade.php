<!-- resources/views/client/appointments/show.blade.php -->
@extends('layouts.client-dashboard')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Appointment Details</h3>
    </div>
    
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Pet Information</h5>
                <div class="border p-3 rounded">
                    <p><strong>Name:</strong> {{ $appointment->pet_name }}</p>
                    <p><strong>Type:</strong> {{ ucfirst($appointment->pet_type) }}</p>
                </div>
            </div>
            
            <div class="col-md-6">
                <h5>Appointment Details</h5>
                <div class="border p-3 rounded">
                    <p><strong>Service:</strong> {{ ucfirst($appointment->service) }}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</p>
                    <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge 
                            @if($appointment->status == 'pending') bg-warning
                            @elseif($appointment->status == 'confirmed') bg-primary
                            @elseif($appointment->status == 'completed') bg-success
                            @else bg-secondary @endif">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <h5>Doctor Information</h5>
                <div class="border p-3 rounded">
                    @if($appointment->doctor)
                        <p><strong>Name:</strong> Dr. {{ $appointment->doctor->firstname }} {{ $appointment->doctor->lastname }}</p>
                        <p><strong>Email:</strong> {{ $appointment->doctor->email }}</p>
                        <p><strong>Phone:</strong> {{ $appointment->doctor->phone ?? 'N/A' }}</p>
                    @else
                        <p class="text-muted">Doctor not assigned yet</p>
                    @endif
                </div>
            </div>
            
            <div class="col-md-6">
                <h5>Client Information</h5>
                <div class="border p-3 rounded">
                    <p><strong>Name:</strong> {{ $appointment->user->firstname }} {{ $appointment->user->lastname }}</p>
                    <p><strong>Email:</strong> {{ $appointment->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $appointment->user->phone ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        
        <div class="mt-4 d-flex justify-content-end">
            <a href="{{ route('client.appointments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
            
            @if($appointment->status == 'pending')
                <a href="{{ route('client.appointments.edit', $appointment->id) }}" class="btn btn-primary ms-2">
                    <i class="fas fa-edit me-1"></i> Edit Appointment
                </a>
            @endif
        </div>
    </div>
</div>
@endsection