@extends('layouts.dashboard')

@section('content')
    <!-- Welcome Section -->
    <div class="welcome-section mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">Welcome back, {{ auth()->user()->name }}! 👋</h4>
                <p class="text-muted">Here's what's happening with your quotes today.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('quotes.create') }}" class="btn btn-primary d-flex align-items-center">
                    <i class="fas fa-plus me-2"></i> Add New Quote
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <!-- Statistics Grid -->
    <div class="grid mb-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #3B82F6, #2563EB);">
            <div class="stat-icon">
                <i class="fas fa-quote-right"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Total Quotes</p>
                <h3 class="stat-value">{{ $quotes->count() }}</h3>
                <p class="stat-desc">Your collection is growing!</p>
            </div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #10B981, #059669);">
            <div class="stat-icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">Categories</p>
                <h3 class="stat-value">{{ $quotes->pluck('tags')->flatten()->unique('id')->count() }}</h3>
                <p class="stat-desc">Unique tags used</p>
            </div>
        </div>

        <div class="stat-card" style="background: linear-gradient(135deg, #F59E0B, #D97706);">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <p class="stat-label">This Week</p>
                <h3 class="stat-value">{{ $quotes->where('created_at', '>=', now()->subDays(7))->count() }}</h3>
                <p class="stat-desc">Quotes added recently</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Quotes Column -->
        <div class="col-12 col-xl-8">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-clock me-2 text-primary"></i>Recent Quotes
                        </h5>
                        <a href="{{ route('quotes.index') }}" class="btn btn-outline-primary btn-sm">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($quotes->count())
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3">Quote</th>
                                        <th class="py-3">Author</th>
                                        <th class="py-3">Tags</th>
                                        <th class="py-3">Added</th>
                                        <th class="py-3 text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quotes->take(5) as $quote)
                                        <tr>
                                            <td class="px-4" style="max-width: 300px;">
                                                <div class="text-truncate fw-medium">{{ $quote->content }}</div>
                                            </td>
                                            <td>
                                                <span class="text-secondary">{{ $quote->author ?? 'Unknown' }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1 flex-wrap">
                                                    @foreach($quote->tags as $tag)
                                                        <span class="badge bg-primary-subtle text-primary">{{ $tag->name }}</span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted" title="{{ $quote->created_at }}">
                                                    {{ $quote->created_at->diffForHumans() }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end gap-2 pe-4">
                                                    <a href="{{ route('quotes.edit', $quote->id) }}"
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="Edit Quote">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('quotes.destroy', $quote->id) }}"
                                                          method="POST"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                                class="btn btn-sm btn-outline-danger delete-quote"
                                                                title="Delete Quote"
                                                                data-quote-id="{{ $quote->id }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteQuoteModal">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state">
                                <div class="empty-state-icon mb-3">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                                <h6 class="fw-semibold text-muted mb-2">No quotes added yet</h6>
                                <p class="text-muted mb-3">Start building your collection by adding your first quote.</p>
                                <a href="{{ route('quotes.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i> Add Your First Quote
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tag Distribution Column -->
        <div class="col-12 col-xl-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2 text-primary"></i>Tag Distribution
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $tagStats = $quotes->pluck('tags')->flatten()
                            ->groupBy('id')
                            ->map(function($group) {
                                $tag = $group->first();
                                return [
                                    'name' => $tag->name,
                                    'count' => $group->count()
                                ];
                            })
                            ->sortByDesc('count')
                            ->values();
                    @endphp

                    @if($tagStats->count())
                        @foreach($tagStats as $tag)
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-primary-subtle text-primary me-2">{{ $tag['name'] }}</span>
                                        <span class="text-muted small">{{ $tag['count'] }} quotes</span>
                                    </div>
                                    <span class="small text-muted">
                                        {{ round(($tag['count'] / $quotes->count()) * 100) }}%
                                    </span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    @php
                                        $percentage = $quotes->count() > 0
                                            ? ($tag['count'] / $quotes->count()) * 100
                                            : 0;
                                    @endphp
                                    <div class="progress-bar"
                                         role="progressbar"
                                         style="width: {{ $percentage }}%"
                                         aria-valuenow="{{ $percentage }}"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <div class="empty-state">
                                <div class="empty-state-icon mb-3">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <h6 class="text-muted mb-2">No tags yet</h6>
                                <p class="text-muted">Add tags to your quotes to see the distribution here.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Quote Modal -->
    <div class="modal fade" id="deleteQuoteModal" tabindex="-1" aria-labelledby="deleteQuoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="deleteQuoteModalLabel">Delete Quote</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <div class="text-center">
                        <div class="display-1 text-danger mb-3">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h5 class="mb-3">Are you sure you want to delete this quote?</h5>
                        <p class="text-muted mb-0">This action cannot be undone.</p>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteQuoteForm" action="" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Quote</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.delete-quote').forEach(button => {
            button.addEventListener('click', function() {
                const quoteId = this.dataset.quoteId;
                const form = document.getElementById('deleteQuoteForm');
                form.action = `/quotes/${quoteId}`;
            });
        });
    </script>
    @endpush
@endsection
