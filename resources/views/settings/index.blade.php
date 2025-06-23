@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Settings</h4>
            <p class="text-muted mb-0">Manage your account preferences</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Settings Form -->
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('settings.update') }}" method="POST">
                        @csrf

                        <!-- Notifications -->
                        <div class="mb-4">
                            <h5 class="card-title mb-3">Notifications</h5>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="email_notifications"
                                       name="email_notifications" value="1"
                                       {{ old('email_notifications', $user->settings['email_notifications'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="email_notifications">
                                    Email Notifications
                                </label>
                                <div class="text-muted small">Receive email notifications about your quotes and interactions</div>
                            </div>
                        </div>

                        <!-- Theme -->
                        <div class="mb-4">
                            <h5 class="card-title mb-3">Appearance</h5>
                            <div class="mb-3">
                                <label class="form-label">Theme</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="theme" id="theme_light"
                                               value="light" {{ (old('theme', $user->settings['theme'] ?? 'light') === 'light') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="theme_light">
                                            <i class="fas fa-sun me-2"></i>Light
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="theme" id="theme_dark"
                                               value="dark" {{ (old('theme', $user->settings['theme'] ?? 'light') === 'dark') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="theme_dark">
                                            <i class="fas fa-moon me-2"></i>Dark
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Language -->
                        <div class="mb-4">
                            <h5 class="card-title mb-3">Language</h5>
                            <div class="mb-3">
                                <select class="form-select" name="language" id="language">
                                    <option value="en" {{ (old('language', $user->settings['language'] ?? 'en') === 'en') ? 'selected' : '' }}>English</option>
                                    <option value="es" {{ (old('language', $user->settings['language'] ?? 'en') === 'es') ? 'selected' : '' }}>Español</option>
                                    <option value="fr" {{ (old('language', $user->settings['language'] ?? 'en') === 'fr') ? 'selected' : '' }}>Français</option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="card border-danger mt-4 border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title text-danger mb-4">Danger Zone</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Delete Account</h6>
                            <p class="text-muted mb-0 small">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                        <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="col-12 col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title mb-3">Quick Links</h5>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-user me-3"></i>
                            Edit Profile
                            <i class="fas fa-chevron-right ms-auto"></i>
                        </a>
                        <a href="{{ route('quotes.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-quote-right me-3"></i>
                            Manage Quotes
                            <i class="fas fa-chevron-right ms-auto"></i>
                        </a>
                        <a href="{{ route('tags.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-tags me-3"></i>
                            Manage Tags
                            <i class="fas fa-chevron-right ms-auto"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-danger">Delete Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-4 text-center">
                <div class="display-1 text-danger mb-3">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h5 class="mb-3">Are you absolutely sure?</h5>
                <p class="text-muted mb-0">
                    This action cannot be undone. This will permanently delete your account, quotes, and remove all associations.
                </p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('profile.destroy') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you absolutely sure you want to delete your account? This action cannot be undone.')">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
