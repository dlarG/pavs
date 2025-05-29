@extends('layouts.doctor-dashboard')

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">Appointment Management</h2>
        <a href="{{ route('doctor.appointments.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Appointment
        </a>
    </div>

    <div class="card-section">
        <div class="table-responsive">
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Pet & Owner</th>
                        <th>Species</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appt)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('imgs/' . strtolower($appt->pet_type) . '.jpg') }}" 
                                    alt="{{ $appt->pet_type }}" 
                                    class="pet-avatar">
                                <div>
                                    <div><strong>{{ $appt->pet_name }}</strong></div>
                                    <div class="small text-muted">
                                        {{ $appt->user->firstname }} {{ $appt->user->lastname }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ ucfirst($appt->pet_type) }}</td>
                        <td>{{ ucfirst($appt->service) }}</td>
                        <td>{{ \Carbon\Carbon::parse($appt->appointment_date)->format('M d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appt->appointment_time)->format('h:i A') }}</td>
                        <td>
                            <span class="status-badge 
                                @if($appt->status == 'pending') status-pending
                                @elseif($appt->status == 'confirmed') status-confirmed
                                @elseif($appt->status == 'completed') status-completed
                                @elseif($appt->status == 'cancelled') status-cancelled
                                @endif">
                                {{ ucfirst($appt->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('doctor.appointments.show', $appt->id) }}" 
                                    class="action-btn me-2" 
                                    title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('doctor.appointments.edit', $appt->id) }}" 
                                    class="action-btn me-2" 
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('doctor.appointments.destroy', $appt->id) }}" 
                                    method="POST" 
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="action-btn text-danger border-0 bg-transparent" 
                                        title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this appointment?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($appointments->isEmpty())
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="fas fa-calendar-times fa-3x text-secondary"></i>
            </div>
            <h4 class="text-muted">No Appointments Found</h4>
            <p class="text-muted">You don't have any appointments scheduled yet.</p>
            <a href="{{ route('doctor.appointments.create') }}" class="btn btn-primary mt-3">
                <i class="fas fa-plus me-2"></i> Create New Appointment
            </a>
        </div>
        @endif
    </div>
</div>
@endsection