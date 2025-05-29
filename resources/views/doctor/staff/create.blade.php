@extends('layouts.doctor-dashboard')

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">Add New Staff Member</h2>
        <a href="{{ route('doctor.staff.index') }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-2"></i> Back to Staff
        </a>
    </div>

    <div class="card-section">
        <form method="POST" action="{{ route('doctor.staff.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="firstname" class="form-label">First Name *</label>
                        <input type="text" name="firstname" class="form-control" required
                            placeholder="Enter first name">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="lastname" class="form-label">Last Name *</label>
                        <input type="text" name="lastname" class="form-control" required
                            placeholder="Enter last name">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required
                            placeholder="Enter email address">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" name="phone" class="form-control"
                            placeholder="Enter phone number">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" name="password" class="form-control" required
                            placeholder="Create password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password *</label>
                        <input type="password" name="password_confirmation" class="form-control" required
                            placeholder="Confirm password">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="reset" class="btn btn-light me-3">
                    <i class="fas fa-redo me-2"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-plus me-2"></i> Add Staff Member
                </button>
            </div>
        </form>
    </div>
</div>
@endsection