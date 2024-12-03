@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3>Edit Post</h3>
    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="4">{{ old('content', $post->content) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="media" class="form-label">Media</label>
            
        
            @if ($post->media)
                <p class="mt-2">Current Media: <img src="{{ asset('storage/' . $post->media) }}" alt="Post Media" class="img-fluid" style="max-height: 200px;"></p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
