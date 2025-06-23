@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h1>Quote of the Day</h1>

    @if($quote)
    <div class="card">
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p>{{ $quote->content }}</p>
                <footer class="blockquote-footer">{{ $quote->author ?? 'Unknown' }}</footer>
            </blockquote>
            <div class="mt-2">
                @foreach($quote->tags as $tag)
                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                @endforeach
            </div>
        </div>
    </div>
    @else
        <p>No quote available today.</p>
    @endif

    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Back to All Quotes</a>
</div>
@endsection
