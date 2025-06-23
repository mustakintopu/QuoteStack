@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Tags</h4>
                <p class="text-muted mb-0">Manage your quote categories</p>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTagModal">
                <i class="fas fa-plus me-2"></i>New Tag
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        <!-- Tags Grid -->
        <div class="row g-4">
            @forelse($tags as $tag)
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">
                                    <span class="badge bg-primary-subtle text-primary fs-6">{{ $tag->name }}</span>
                                </h5>
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <button class="dropdown-item" type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editTagModal{{ $tag->id }}">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item text-danger" type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteTagModal{{ $tag->id }}">
                                                <i class="fas fa-trash me-2"></i>Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex align-items-center text-muted mb-3">
                                <i class="fas fa-quote-right me-2"></i>
                                <span>{{ $tag->quotes_count }} {{ Str::plural('quote', $tag->quotes_count) }}</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar" role="progressbar" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Tag Modal -->
                    <div class="modal fade" id="editTagModal{{ $tag->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('tags.update', $tag) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="modal-title">Edit Tag</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body py-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tag Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $tag->name }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 pt-0">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update Tag</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Tag Modal -->
                    <div class="modal fade" id="deleteTagModal{{ $tag->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0 pb-0">
                                    <h5 class="modal-title">Delete Tag</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body py-4 text-center">
                                    <div class="display-1 text-danger mb-3">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                    <h5 class="mb-3">Are you sure you want to delete this tag?</h5>
                                    <p class="text-muted mb-0">
                                        This action cannot be undone. The tag will be permanently removed from any quotes using it.
                                    </p>
                                </div>
                                <div class="modal-footer border-0 pt-0">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete Tag</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <div class="empty-state-icon mb-3">
                                <i class="fas fa-tags"></i>
                            </div>
                            <h6 class="fw-semibold text-muted mb-2">No Tags Found</h6>
                            <p class="text-muted mb-3">Start organizing your quotes by creating tags.</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTagModal">
                                <i class="fas fa-plus me-2"></i>Create Your First Tag
                            </button>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Create Tag Modal -->
    <div class="modal fade" id="createTagModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('tags.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title">Create New Tag</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body py-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tag Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
