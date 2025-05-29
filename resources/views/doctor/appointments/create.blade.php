@extends('layouts.doctor-dashboard')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">Create New Appointment</h2>
        <a href="{{ route('doctor.appointments.index') }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-2"></i> Back to Appointments
        </a>
    </div>

    <div class="card-section">
        <form method="POST" action="{{ route('doctor.appointments.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="pet_name" class="form-label">Pet Name</label>
                        <input type="text" name="pet_name" class="form-control" required
                            placeholder="Enter pet name">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="pet_type" class="form-label">Pet Type</label>
                        <select name="pet_type" class="form-control" required>
                            <option value="">-- Select Pet Type --</option>
                            <option value="dog">Dog</option>
                            <option value="cat">Cat</option>
                            <option value="bird">Bird</option>
                            <option value="rabbit">Rabbit</option>
                            <option value="hamster">Hamster</option>
                            <option value="other">Other</option>
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
                            <option value="consultation">Consultation</option>
                            <option value="vaccination">Vaccination</option>
                            <option value="grooming">Grooming</option>
                            <option value="deworming">Deworming</option>
                            <option value="laboratory">Laboratory Test</option>
                            <option value="surgery">Surgery</option>
                            <option value="dental">Dental Care</option>
                            <option value="emergency">Emergency Care</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="doctor_id" class="form-label">Doctor</label>
                        <select name="doctor_id" class="form-control" required>
                            <option value="">-- Select Doctor --</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">
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
                        <input type="date" name="appointment_date" class="form-control" required>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="appointment_time" class="form-label">Time</label>
                        <input type="time" name="appointment_time" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="notes" class="form-label">Notes (Optional)</label>
                <textarea name="notes" class="form-control" rows="3" 
                    placeholder="Any special instructions or notes"></textarea>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="reset" class="btn btn-light me-3">
                    <i class="fas fa-redo me-2"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-calendar-plus me-2"></i> Create Appointment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection