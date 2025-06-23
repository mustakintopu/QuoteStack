@extends('layouts.dashboard')

@section('content')
<div class="container mt-2">

    <form action="{{ url('/search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search by author or tag..." value="{{ request('q') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($quotes as $quote)
    <div class="card mb-3">
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p>{{ $quote->content }}</p>
                <footer class="blockquote-footer">
                    {{ $quote->author ?? 'Unknown' }}
                    <span class="text-muted"> | Added on {{ $quote->created_at->format('d M Y') }}</span>
                </footer>
            </blockquote>

            <div class="mt-2">
                @foreach ($quote->tags as $tag)
                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                @endforeach
            </div>

            <div class="mt-3 d-flex align-items-center justify-content-between">
                <div>
                    <a href="{{ url('/quotes/' . $quote->id . '/edit') }}?q={{ request('q') }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ url('/quotes/' . $quote->id) }}?q={{ request('q') }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>

                <!-- ⭐ Favorite Button -->
                <form action="{{ route('quotes.favorite', $quote->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 border-0">
                        @if($quote->is_favorite)
                            <i class="bi bi-star-fill text-warning" style="font-size: 1.3rem;"></i>
                        @else
                            <i class="bi bi-star text-muted" style="font-size: 1.3rem;"></i>
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
@empty
    <p>No quotes found.</p>
@endforelse

</div>
@endsection
