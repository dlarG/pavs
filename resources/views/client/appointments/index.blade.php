<!-- resources/views/client/appointments/index.blade.php -->
@extends('layouts.client-dashboard')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h3 class="mb-0">My Appointments</h3>
        <a href="{{ route('client.appointments.create') }}" class="btn btn-light">
            <i class="fas fa-plus me-2"></i> New Appointment
        </a>
    </div>
    
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if($appointments->isEmpty())
            <div class="alert alert-info">
                You have no appointments scheduled.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Pet Name</th>
                            <th>Service</th>
                            <th>Date & Time</th>
                            <th>Doctor</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->pet_name }}</td>
                            <td>{{ ucfirst($appointment->service) }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                                at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                            </td>
                            <td>
                                @if($appointment->doctor)
                                    Dr. {{ $appointment->doctor->firstname }} {{ $appointment->doctor->lastname }}
                                @else
                                    Not assigned
                                @endif
                            </td>
                            <td>
                                <span class="badge 
                                    @if($appointment->status == 'pending') bg-warning
                                    @elseif($appointment->status == 'confirmed') bg-primary
                                    @elseif($appointment->status == 'completed') bg-success
                                    @else bg-secondary @endif">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('client.appointments.show', $appointment->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($appointment->status == 'pending')
                                    <a href="{{ route('client.appointments.edit', $appointment->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('client.appointments.destroy', $appointment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection