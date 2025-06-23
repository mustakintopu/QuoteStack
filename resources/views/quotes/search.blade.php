@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Search Results</h2>

    @if(isset($results) && count($results))
        <div class="row">
            @foreach($results as $quote)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <blockquote class="blockquote">
                                <p>{{ $quote->content }}</p>
                                <footer class="blockquote-footer">{{ $quote->author ?? 'Unknown' }}</footer>
                            </blockquote>
                            <div>
                                @foreach($quote->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No quotes found matching your search.</p>
    @endif
</div>
@endsection
