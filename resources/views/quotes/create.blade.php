@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h1>Add New Quote</h1>

    <form action="{{ url('/quotes') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="content" class="form-label">Quote Content</label>
            <textarea name="content" id="content" rows="3" class="form-control" required>{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author (optional)</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ old('author') }}">
        </div>

        <div class="mb-3">
    <label for="built_in_tag" class="form-label">Choose a Built-in Tag</label>
    <select name="built_in_tag" id="built_in_tag" class="form-select">
        <option value="">-- Select a Tag --</option>
        <option value="Motivational">Motivational</option>
        <option value="Life">Life</option>
        <option value="Funny">Funny</option>
        <option value="Love">Love</option>
        <option value="Success">Success</option>
        <option value="Wisdom">Wisdom</option>
    </select>
</div>

        <div class="mb-3">
            <label for="tags" class="form-label">Or Add New Tags (comma-separated)</label>
            <input type="text" name="tags" id="tags" class="form-control" value="{{ old('tags') }}">
            <small class="form-text text-muted">Example: happiness, strength</small>
        </div>


        <button type="submit" class="btn btn-primary">Add Quote</button>
        <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
