@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3>Create Post</h3>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label for="media" class="form-label">Media</label>
            <input type="file" class="form-control" id="media" accept="image/*,video/*" name="media" >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
