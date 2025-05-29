@extends('layouts.doctor-dashboard')

@push('styles')
@endpush

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">Appointment Details</h2>
        <a href="{{ route('doctor.appointments.index') }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-2"></i> Back to Appointments
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card-section">
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('imgs/' . strtolower($appointment->pet_type) . '.jpg') }}" 
                        alt="{{ $appointment->pet_type }}" 
                        class="pet-avatar-lg" style="width: 50px;
                                height: 50px;
                                border-radius: 50%;
                                object-fit: cover;
                                border: 3px solid #eaeaea;">
                    <div class="ms-4">
                        <h3 class="mb-1">{{ $appointment->pet_name }}</h3>
                        <p class="text-muted mb-0">
                            <i class="fas fa-paw me-1"></i> {{ ucfirst($appointment->pet_type) }}
                        </p>
                        <p class="text-muted mb-0">
                            <i class="fas fa-user me-1"></i> {{ $appointment->user->firstname }} {{ $appointment->user->lastname }}
                        </p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="detail-card" style="background: #f8f9fc;
                            border-radius: 8px;
                            padding: 15px;
                            margin-bottom: 15px;">
                            <div class="detail-label" style="font-size: 0.85rem;
                                color: #6c757d;
                                margin-bottom: 5px;">Service</div>
                            <div class="detail-value" style="font-weight: 500; font-size: 1.1rem;">{{ ucfirst($appointment->service) }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-card" style="background: #f8f9fc;
                            border-radius: 8px;
                            padding: 15px;
                            margin-bottom: 15px;">
                            <div class="detail-label" style="font-size: 0.85rem;
                                color: #6c757d;
                                margin-bottom: 5px;">Date</div>
                            <div class="detail-value" style="font-weight: 500; font-size: 1.1rem;">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-card" style="background: #f8f9fc;
                            border-radius: 8px;
                            padding: 15px;
                            margin-bottom: 15px;">
                            <div class="detail-label" style="font-size: 0.85rem;
                                color: #6c757d;
                                margin-bottom: 5px;">Time</div>
                            <div class="detail-value" style="font-weight: 500; font-size: 1.1rem;">
                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>

                @if($appointment->notes)
                <div class="detail-card mb-4"  style="background: #f8f9fc;
                            border-radius: 8px;
                            padding: 15px;
                            margin-bottom: 15px;">
                    <div class="detail-label" style="font-size: 0.85rem;
                                color: #6c757d;
                                margin-bottom: 5px;">Notes</div>
                    <div class="detail-value" style="font-weight: 500; font-size: 1.1rem;">{{ $appointment->notes }}</div>
                </div>
                @endif

                <div class="detail-card" style="background: #f8f9fc;
                            border-radius: 8px;
                            padding: 15px;
                            margin-bottom: 15px;">
                    <div class="detail-label" style="font-size: 0.85rem;
                                color: #6c757d;
                                margin-bottom: 5px;">Status</div>
                    <div class="d-flex align-items-center">
                        <span class="status-badge 
                            @if($appointment->status == 'pending') status-pending
                            @elseif($appointment->status == 'confirmed') status-confirmed
                            @elseif($appointment->status == 'completed') status-completed
                            @elseif($appointment->status == 'cancelled') status-cancelled
                            @endif me-3"
                            style="
                                @if($appointment->status == 'pending')
                                    background: rgba(246, 194, 62, 0.2); color: #f6c23e;
                                @elseif($appointment->status == 'confirmed')
                                    background: rgba(54, 185, 204, 0.2); color: #36b9cc;
                                @elseif($appointment->status == 'completed')
                                    background: rgba(28, 200, 138, 0.2); color: #1cc88a;
                                @elseif($appointment->status == 'cancelled')
                                    background: rgba(231, 74, 59, 0.2); color: #e74a3b;
                                @endif
                                font-weight: 500;
                                padding: 4px 12px;
                                border-radius: 20px;
                                font-size: 0.95rem;
                            ">
                            {{ ucfirst($appointment->status) }}
                        </span>
                        
                        <form action="{{ route('doctor.appointments.updateStatus', $appointment->id) }}" 
                            method="POST" 
                            class="d-flex align-items-center">
                            @csrf
                            @method('PATCH')
                            <select name="status" id="status" class="form-control form-control-sm me-2" 
                                style="width: auto;" required>
                                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-sync me-1"></i> Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-section">
                <h5 class="mb-4">Appointment Actions</h5>
                
                <div class="d-grid gap-3">
                    <a href="{{ route('doctor.appointments.edit', $appointment->id) }}" 
                        class="btn btn-outline-primary text-start">
                        <i class="fas fa-edit me-2"></i> Edit Appointment
                    </a>
                    
                    <form action="{{ route('doctor.appointments.destroy', $appointment->id) }}" 
                        method="POST" 
                        class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="btn btn-outline-danger text-start"
                            onclick="return confirm('Are you sure you want to delete this appointment?')">
                            <i class="fas fa-trash me-2"></i> Delete Appointment
                        </button>
                    </form>
                    <a href="mailto:{{ $appointment->user->email }}" class="btn btn-outline-info text-start">
                        <i class="fas fa-envelope me-2"></i> Email Owner
                    </a>
                    
                    <a href="tel:{{ $appointment->user->phone }}" class="btn btn-outline-secondary text-start">
                        <i class="fas fa-phone me-2"></i> Call Owner
                    </a>
                </div>
                
                <hr class="my-4">
                
                <h6 class="mb-3">Appointment History</h6>
                <div class="timeline" style="position: relative; padding-left: 30px;">
                    <div style="content: ''; position: absolute; left: -21px; top: 0; bottom: 0; width: 2px; background: #eaeaea;"></div>
                    <div class="timeline-item" style="position: relative; margin-bottom: 20px;">
                        <div class="timeline-badge bg-primary" style="position: absolute; left: -30px; top: 0; width: 20px; height: 20px; border-radius: 50%; z-index: 1; background: #0d6efd;"></div>
                        <div class="timeline-content" style="padding: 10px 15px; background: #f8f9fc; border-radius: 8px;">
                            <div class="timeline-date" style="font-size: 0.8rem; color: #6c757d; margin-bottom: 5px;">May 28, 2023 10:30 AM</div>
                            <div class="timeline-text" style="font-size: 0.9rem;">Appointment created by Dr. Smith</div>
                        </div>
                    </div>
                    <div class="timeline-item" style="position: relative; margin-bottom: 20px;">
                        <div class="timeline-badge bg-info" style="position: absolute; left: -30px; top: 0; width: 20px; height: 20px; border-radius: 50%; z-index: 1; background: #0dcaf0;"></div>
                        <div class="timeline-content" style="padding: 10px 15px; background: #f8f9fc; border-radius: 8px;">
                            <div class="timeline-date" style="font-size: 0.8rem; color: #6c757d; margin-bottom: 5px;">May 28, 2023 11:15 AM</div>
                            <div class="timeline-text" style="font-size: 0.9rem;">Status changed to Confirmed</div>
                        </div>
                    </div>
                    <div class="timeline-item" style="position: relative; margin-bottom: 20px;">
                        <div class="timeline-badge bg-warning" style="position: absolute; left: -30px; top: 0; width: 20px; height: 20px; border-radius: 50%; z-index: 1; background: #ffc107;"></div>
                        <div class="timeline-content" style="padding: 10px 15px; background: #f8f9fc; border-radius: 8px;">
                            <div class="timeline-date" style="font-size: 0.8rem; color: #6c757d; margin-bottom: 5px;">May 30, 2023 09:45 AM</div>
                            <div class="timeline-text" style="font-size: 0.9rem;">Reminder sent to owner</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
