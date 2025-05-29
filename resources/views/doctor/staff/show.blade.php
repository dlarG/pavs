@extends('layouts.doctor-dashboard')

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">Staff Details</h2>
        <a href="{{ route('doctor.staff.index') }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-2"></i> Back to Staff
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card-section">
                <div class="d-flex align-items-center mb-4">
                    <div class="avatar avatar-xl bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-4">
                        {{ substr($staff->firstname, 0, 1) }}{{ substr($staff->lastname, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="mb-1">{{ $staff->firstname }} {{ $staff->lastname }}</h3>
                        <p class="text-muted mb-0">
                            <i class="fas fa-briefcase me-1"></i> {{ $staff->position }}
                        </p>
                        <p class="text-muted mb-0">
                            <i class="fas fa-id-badge me-1"></i> Staff ID: {{ $staff->id }}
                        </p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="detail-card">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">
                                <a href="mailto:{{ $staff->email }}">{{ $staff->email }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-card">
                            <div class="detail-label">Phone</div>
                            <div class="detail-value">
                                @if($staff->phone)
                                    <a href="tel:{{ $staff->phone }}">{{ $staff->phone }}</a>
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="detail-card">
                            <div class="detail-label">Account Created</div>
                            <div class="detail-value">
                                {{ $staff->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-card">
                            <div class="detail-label">Last Updated</div>
                            <div class="detail-value">
                                {{ $staff->updated_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail-card">
                    <div class="detail-label">Account Status</div>
                    <div class="d-flex align-items-center">
                        <span class="status-badge status-confirmed me-3">
                            Active
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-section">
                <h5 class="mb-4">Staff Actions</h5>
                
                <div class="d-grid gap-3">
                    <a href="{{ route('doctor.staff.edit', $staff->id) }}" 
                        class="btn btn-outline-primary text-start">
                        <i class="fas fa-edit me-2"></i> Edit Staff Details
                    </a>
                    
                    <form action="{{ route('doctor.staff.destroy', $staff->id) }}" 
                        method="POST" 
                        class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="btn btn-outline-danger text-start"
                            onclick="return confirm('Are you sure you want to delete this staff member?')">
                            <i class="fas fa-trash me-2"></i> Delete Staff Member
                        </button>
                    </form>
                    
                    <a href="#" class="btn btn-outline-info text-start">
                        <i class="fas fa-envelope me-2"></i> Send Message
                    </a>
                    
                    <a href="#" class="btn btn-outline-secondary text-start">
                        <i class="fas fa-key me-2"></i> Reset Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .avatar-xl {
        width: 80px;
        height: 80px;
        font-size: 1.8rem;
        font-weight: 600;
    }
</style>
@endsection