
@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h1>Edit Quote</h1>

    <form action="{{ url('/quotes/' . $quote->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="content" class="form-label">Quote Content</label>
            <textarea name="content" id="content" rows="3" class="form-control" required>{{ old('content', $quote->content) }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author (optional)</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $quote->author) }}">
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags (separate multiple tags with commas)</label>
            <input type="text" name="tags" id="tags" class="form-control"
                value="{{ old('tags', $quote->tags->pluck('name')->implode(', ')) }}">
            <small class="form-text text-muted">Example: motivation, life, funny</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Quote</button>
        <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
