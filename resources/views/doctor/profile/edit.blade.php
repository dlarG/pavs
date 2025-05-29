<!-- resources/views/doctor/profile/edit.blade.php -->
@extends('layouts.doctor-dashboard')

@section('content')
<div class="content-wrapper" style="">
    <h2 class="section-title" style="text-align: center; margin-bottom: 40px; color: #3a6ea5; font-weight: 600; position: relative; padding-bottom: 15px;">
        Edit Profile
        <span style="content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 4px; background: linear-gradient(to right, #3a6ea5, #17a2b8); border-radius: 2px; display: block;"></span>
    </h2>

    @if($errors->any())
        <div class="alert alert-danger" style="padding: 15px; border-radius: 10px; margin-bottom: 25px; display: flex; align-items: center; gap: 12px; background: rgba(220, 53, 69, 0.15); color: #c82333; border-left: 4px solid #dc3545;">
            <i class="fas fa-exclamation-circle me-2"></i>
            <div>
                <strong>Please fix the following errors:</strong>
                <ul class="mt-2 mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="card" style="border-radius: 16px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); overflow: hidden; transition: all 0.3s ease; margin-bottom: 30px; border: none;">
        <div class="card-header bg-primary text-white" style="padding: 20px 30px; position: relative;">
            <h3 class="mb-0"><i class="fas fa-user-edit me-2"></i> Update Profile Information</h3>
        </div>
        
        <div class="card-body">
            <form action="{{ route('doctor.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                @csrf
                
                <div class="preview-container text-center" style="margin: 20px 0 30px;">
                    <div class="preview-title" style="margin-bottom: 15px; color: #343a40; font-weight: 500; font-size: 1.1rem;">Profile Picture Preview</div>
                    <div class="profile-pic-container-edit mb-3" style="width: 180px; height: 180px; margin: 0 auto; border-radius: 50%; border: 5px solid white; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); background: white; overflow: hidden;">
                        @if($doctor->profile_picture)
                            <img id="imagePreview" src="{{ Storage::url($doctor->profile_picture) }}" class="profile-pic" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div id="imagePreview" class="profile-pic bg-light d-flex align-items-center justify-content-center" style="width: 100%; height: 100%; object-fit: cover;">
                                <i class="fas fa-user-md text-primary" style="font-size: 5rem;"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="file-input-wrapper" style="position: relative; display: inline-block; margin-top: 15px;">
                        <label class="file-input-label" style="display: inline-flex; align-items: center; background: linear-gradient(135deg, #3a6ea5 0%, #2c8fd1 100%); color: white; padding: 10px 20px; border-radius: 50px; cursor: pointer; transition: all 0.3s ease; font-weight: 500;">
                            <i class="fas fa-camera me-2"></i> Change Photo
                            <input type="file" name="profile_picture" class="file-input" accept="image/*" onchange="previewImage(event)" style="position: absolute; left: 0; top: 0; opacity: 0; width: 100%; height: 100%; cursor: pointer;">
                        </label>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 500; color: #343a40;">First Name *</label>
                        <input type="text" name="firstname" class="form-control" value="{{ old('firstname', $doctor->firstname) }}" required style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; font-size: 16px; transition: all 0.3s ease;">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 500; color: #343a40;">Last Name *</label>
                        <input type="text" name="lastname" class="form-control" value="{{ old('lastname', $doctor->lastname) }}" required style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; font-size: 16px; transition: all 0.3s ease;">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 500; color: #343a40;">Email *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}" required style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; font-size: 16px; transition: all 0.3s ease;">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 500; color: #343a40;">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; font-size: 16px; transition: all 0.3s ease;">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 500; color: #343a40;">New Password (optional)</label>
                        <input type="password" name="password" class="form-control" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; font-size: 16px; transition: all 0.3s ease;">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label" style="display: block; margin-bottom: 8px; font-weight: 500; color: #343a40;">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" style="width: 100%; padding: 12px 15px; border-radius: 10px; border: 1px solid #ddd; font-size: 16px; transition: all 0.3s ease;">
                    </div>
                </div>
                
                <div class="btn-container mt-4" style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                    <a href="{{ route('doctor.profile.show') }}" class="btn btn-secondary" style="padding: 12px 30px; border-radius: 50px; font-weight: 500; display: inline-flex; align-items: center; transition: all 0.3s ease; border: none; cursor: pointer; font-size: 16px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #6c757d 0%, #868e96 100%); color: white;">
                        <i class="fas fa-times me-2"></i> Cancel
                    </a>
                    
                    <button type="submit" class="btn btn-primary" style="padding: 12px 30px; border-radius: 50px; font-weight: 500; display: inline-flex; align-items: center; transition: all 0.3s ease; border: none; cursor: pointer; font-size: 16px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #3a6ea5 0%, #2c8fd1 100%); color: white;">
                        <i class="fas fa-save me-2"></i> Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Check if the preview element is an image or div
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    // Replace the div with an image
                    const newPreview = document.createElement('img');
                    newPreview.id = 'imagePreview';
                    newPreview.className = 'profile-pic';
                    newPreview.src = e.target.result;
                    newPreview.alt = 'Preview';
                    newPreview.style = "width: 100%; height: 100%; object-fit: cover;";
                    preview.parentNode.replaceChild(newPreview, preview);
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
