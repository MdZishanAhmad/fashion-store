@extends('components.main')

@section('title', 'My Profile')

@section('user-body')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">My Profile</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="text-center mb-4">
                        <img src="{{ $user->photo ? asset($user->photo) : asset('assets/images/default-avatar.png') }}" 
                             alt="Profile Photo" 
                             class="rounded-circle"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Name:</div>
                        <div class="col-md-8">{{ $user->name }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email:</div>
                        <div class="col-md-8">{{ $user->email }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Phone:</div>
                        <div class="col-md-8">{{ $user->phone }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Member Since:</div>
                        <div class="col-md-8">{{ $user->created_at->format('F d, Y') }}</div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection