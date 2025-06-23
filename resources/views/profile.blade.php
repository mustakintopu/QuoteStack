@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary fw-bold">My Profile</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="row g-0 p-4 align-items-center">
            <div class="col-md-3 text-center">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-circle border border-3 border-primary" style="max-width: 180px; object-fit: cover;">
                @else
                    <img src="{{ asset('default-profile.png') }}" alt="Default Profile" class="img-fluid rounded-circle border border-3 border-secondary" style="max-width: 180px;">
                @endif
            </div>

            <div class="col-md-9">
                <div class="card-body ps-md-4">
                    <h3 class="card-title fw-bold mb-3">{{ $user->name }}</h3>
                    <p class="mb-2"><strong>Email:</strong> <span class="text-muted">{{ $user->email }}</span></p>
                    <p class="mb-2"><strong>Username:</strong> <span class="text-muted">{{ $user->username ?? 'Not set' }}</span></p>
                    <p class="mb-2"><strong>Bio:</strong> <span class="text-muted">{{ $user->bio ?? 'No bio provided.' }}</span></p>
                    <p class="mb-2"><strong>Joined on:</strong> <span class="text-muted">{{ $user->created_at->format('d M Y') }}</span></p>

                    <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-4 px-4">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
