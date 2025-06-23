@extends('layouts.dashboard')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-4">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                                <i class="fas fa-user fa-4x text-white"></i>
                            </div>
                        @endif
                    </div>
                    <h3 class="mb-0">{{ $user->name }}</h3>
                    @if($user->username)
                        <p class="text-muted mb-2">{{ '@' . $user->username }}</p>
                    @endif
                    @if($user->bio)
                        <p class="mb-3">{{ $user->bio }}</p>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary w-100 mt-2">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-transparent border-bottom-0">
                    <h5 class="mb-0">Account Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Email</div>
                        <div class="col-sm-8">{{ $user->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Member Since</div>
                        <div class="col-sm-8">{{ $user->created_at->format('F Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Last Updated</div>
                        <div class="col-sm-8">{{ $user->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-transparent border-bottom-0">
                    <h5 class="mb-0">Activity</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="border rounded p-3 bg-primary-subtle">
                                <i class="fas fa-quote-right fa-2x text-primary mb-2"></i>
                                <h4 class="mb-1">{{ $user->quotes()->count() }}</h4>
                                <div class="text-muted">Quotes</div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="border rounded p-3 bg-success-subtle">
                                <i class="fas fa-tags fa-2x text-success mb-2"></i>
                                <h4 class="mb-1">{{ $user->tags()->count() }}</h4>
                                <div class="text-muted">Tags</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 bg-danger-subtle">
                                <i class="fas fa-heart fa-2x text-danger mb-2"></i>
                                <h4 class="mb-1">{{ $user->favorites()->count() }}</h4>
                                <div class="text-muted">Favorites</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
