@extends('components.main')

@section('title', 'Edit Profile')

@section('user-body')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }

    .profile-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 25px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .profile-header h4 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #2c3e50;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 10px 15px;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #2c3e50;
        box-shadow: 0 0 0 0.2rem rgba(44, 62, 80, 0.25);
    }

    .btn-primary {
        background: #2c3e50;
        border: none;
        padding: 10px 25px;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background: #34495e;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: #95a5a6;
        border: none;
        padding: 10px 25px;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-secondary:hover {
        background: #7f8c8d;
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 5px;
        padding: 15px 20px;
        margin-bottom: 20px;
        border: none;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .photo-upload {
        position: relative;
        display: inline-block;
    }

    .photo-upload input[type="file"] {
        display: none;
    }

    .photo-upload-label {
        display: inline-block;
        padding: 8px 15px;
        background: #2c3e50;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .photo-upload-label:hover {
        background: #34495e;
    }

    .invalid-feedback {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 5px;
    }

    @media (max-width: 768px) {
        .profile-container {
            margin: 15px;
            padding: 20px;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
        }
    }
</style>

<div class="container">
    <div class="profile-container">
        <div class="profile-header">
            <h4><i class="fas fa-user-edit me-2"></i>Edit Profile</h4>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="text-center mb-4">
                <img src="{{ $user->photo ? asset($user->photo) : asset('assets/images/default-avatar.png') }}" 
                     alt="Profile Photo" 
                     class="profile-photo"
                     id="profile-preview">
                
                <div class="photo-upload">
                    <label for="photo" class="photo-upload-label">
                        <i class="fas fa-camera me-2"></i>Change Photo
                    </label>
                    <input type="file" 
                           class="form-control @error('photo') is-invalid @enderror" 
                           id="photo" 
                           name="photo" 
                           accept="image/*"
                           onchange="previewImage(this)">
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $user->name) }}" 
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}" 
                       required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" 
                       class="form-control @error('phone') is-invalid @enderror" 
                       id="phone" 
                       name="phone" 
                       value="{{ old('phone', $user->phone) }}" 
                       pattern="[0-9]{10}"
                       maxlength="10"
                       required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Profile
                </button>
                <a href="{{ route('user.profile') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('profile-preview').src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Phone number validation
document.getElementById('phone').addEventListener('input', function(e) {
    this.value = this.value.replace(/\D/g, '');
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
    }
});
</script>

@endsection