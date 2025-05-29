<!-- resources/views/doctor/profile/show.blade.php -->
@extends('layouts.doctor-dashboard')

@section('content')
<div class="content-wrapper">
    <h2 class="section-title" style="text-align: center; margin-bottom: 40px; color: #3a6ea5; font-weight: 600; position: relative; padding-bottom: 15px;">
        My Profile
        <span style="content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 4px; background: linear-gradient(to right, #3a6ea5, #17a2b8); border-radius: 2px; display: block;"></span>
    </h2>

    @if(session('success'))
        <div class="alert alert-success" style="padding: 15px; border-radius: 10px; margin-bottom: 25px; display: flex; align-items: center; gap: 12px; background: rgba(40, 167, 69, 0.15); color: #218838; border-left: 4px solid #28a745;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card" style="border-radius: 16px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); overflow: hidden; transition: all 0.3s ease; margin-bottom: 30px; border: none;">
        <div class="card-header bg-primary text-white" style="padding: 20px 30px; position: relative;">
            <h3 class="mb-0"><i class="fas fa-user-md me-2"></i> Doctor Profile</h3>
        </div>
        
        <div class="profile-pic-container" style="position: relative; width: 180px; height: 180px; margin: -90px auto 20px; border-radius: 50%; border: 5px solid white; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); background: white; overflow: hidden; z-index: 10;">
            @if($doctor->profile_picture)
                <img src="{{ Storage::url($doctor->profile_picture) }}" class="profile-pic" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover; transition: all 0.3s ease;">
            @else
                <div class="profile-pic bg-light d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                    <i class="fas fa-user-md text-primary" style="font-size: 5rem;"></i>
                </div>
            @endif
        </div>
        
        <div class="card-body">
            <div class="profile-info" style="text-align: center; margin-bottom: 30px;">
                <h2 class="profile-name" style="font-size: 28px; font-weight: 700; margin-bottom: 5px; color: #343a40;">Dr. {{ $doctor->firstname }} {{ $doctor->lastname }}</h2>
                <div class="profile-role" style="color: #3a6ea5; font-weight: 500; background: rgba(58, 110, 165, 0.1); padding: 5px 15px; border-radius: 20px; display: inline-block; margin-bottom: 20px;">
                    {{ ucfirst($doctor->role) }}
                </div>
            </div>
            
            <div class="profile-details" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <div class="detail-card" style="background: #f8f9fa; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 15px; transition: all 0.3s ease;">
                    <div class="detail-icon bg-primary" style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; background: #0d6efd;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="detail-content">
                        <h4 style="font-size: 14px; color: #6c757d; margin-bottom: 5px;">Email</h4>
                        <p style="font-size: 18px; font-weight: 500; color: #343a40;">{{ $doctor->email }}</p>
                    </div>
                </div>
                
                <div class="detail-card" style="background: #f8f9fa; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 15px; transition: all 0.3s ease;">
                    <div class="detail-icon bg-primary" style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; background: #0d6efd;">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="detail-content">
                        <h4 style="font-size: 14px; color: #6c757d; margin-bottom: 5px;">Phone</h4>
                        <p style="font-size: 18px; font-weight: 500; color: #343a40;">{{ $doctor->phone ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="detail-card" style="background: #f8f9fa; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 15px; transition: all 0.3s ease;">
                    <div class="detail-icon bg-primary" style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; background: #0d6efd;">
                        <i class="fas fa-venus-mars"></i>
                    </div>
                    <div class="detail-content">
                        <h4 style="font-size: 14px; color: #6c757d; margin-bottom: 5px;">Gender</h4>
                        <p style="font-size: 18px; font-weight: 500; color: #343a40;">{{ $doctor->gender ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="detail-card" style="background: #f8f9fa; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 15px; transition: all 0.3s ease;">
                    <div class="detail-icon bg-primary" style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; background: #0d6efd;">
                        <i class="fas fa-birthday-cake"></i>
                    </div>
                    <div class="detail-content">
                        <h4 style="font-size: 14px; color: #6c757d; margin-bottom: 5px;">Date of Birth</h4>
                        <p style="font-size: 18px; font-weight: 500; color: #343a40;">{{ $doctor->date_of_birth ? $doctor->date_of_birth->format('F j, Y') : 'N/A' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="btn-container" style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                <a href="{{ route('doctor.profile.edit') }}" class="btn btn-edit" style="padding: 12px 30px; border-radius: 50px; font-weight: 500; display: inline-flex; align-items: center; transition: all 0.3s ease; border: none; cursor: pointer; font-size: 16px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #3a6ea5 0%, #2c8fd1 100%); color: white;">
                    <i class="fas fa-edit me-2"></i> Edit Profile
                </a>
                
                <form action="{{ route('doctor.profile.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" style="padding: 12px 30px; border-radius: 50px; font-weight: 500; display: inline-flex; align-items: center; transition: all 0.3s ease; border: none; cursor: pointer; font-size: 16px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #dc3545 0%, #e84c5a 100%); color: white;">
                        <i class="fas fa-trash me-2"></i> Delete Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
