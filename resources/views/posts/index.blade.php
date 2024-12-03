@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-3">
        <div class="col-12 text-end">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
        </div>
    </div>
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $post->media ? asset('storage/' . $post->media) : asset('default-media.png') }}" class="card-img-top" alt="Post Media">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                            
                        </form>

                        <div class="post">
    
    <div class="actions">
        <button class="btn btn-light like-btn" data-id="{{ $post->id }}">
            Like ({{ $post->likes_count }})
        </button>
        <button class="btn btn-light dislike-btn" data-id="{{ $post->id }}">
            Dislike ({{ $post->dislikes_count }})
        </button>
    </div>
</div>
<div class="comments-section">
    <h4>Comments</h4>
    <form id="comment-form">
        <textarea name="content" class="form-control" placeholder="Write a comment..."></textarea>
        <button type="submit" class="btn btn-primary">Comment</button>
    </form>

    <ul class="comments-list">
        @foreach ($post->comments as $comment)
            <li>
                <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                <button class="btn btn-danger btn-sm delete-comment" data-id="{{ $comment->id }}">Delete</button>
            </li>
        @endforeach
    </ul>
</div>



                    </div>
                </div>
            </div>
        @endforeach
        <script>
    $('form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                $('.comments-section').prepend(`
                    <div class="comment">
                        <strong>${response.user.name}</strong>: 
                        <span>${response.content}</span>
                    </div>
                `);
                $('textarea[name="content"]').val('');
            },
            error: function () {
                alert('Error adding comment.');
            }
        });
    });
</script>

<script>
    function toggleLike(postId) {
        $.ajax({
            url: `/posts/${postId}/toggle-like`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $(`#like-count-${postId}`).text(response.likes);
                $(`#dislike-count-${postId}`).text(response.dislikes);
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    }
</script>



    </div>
</div>
@endsection

