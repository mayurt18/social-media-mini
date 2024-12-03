<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

 public function store(Request $request)
{
    try {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480', // Max 20MB
        ]);
        
        // Log the incoming request
        Log::info('Store Post Request: ', $request->all());

        // Create a new Post instance
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;

        // Handle media upload
        if ($request->hasFile('media')) {
            $filePath = $request->file('media')->store('uploads', 'public');
            Log::info('Media uploaded successfully. File Path: ' . $filePath);
            $post->media = $filePath;
        } else {
            Log::warning('No media file provided for the post.');
        }

        // Associate the post with the currently authenticated user
        $post->user_id = auth()->id();

        // Save the post
        $post->save();
       
        Log::info('Post created successfully with ID: ' . $post->id);

        // Redirect back with a success message
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    } catch (\Exception $e) {
        // Log the exception
        Log::error('Error while creating post: ' . $e->getMessage());

        // Redirect back with an error message
        return redirect()->back()->with('error', 'There was an error creating the post. Please try again.');
    }
}


    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:20480',
        ]);

        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->store('media', 'public');
            $post->update(['media' => $mediaPath]);
        }

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
    public function likePost(Request $request, $id)
{
    $post = Post::findOrFail($id);

    // Increment the likes count
    $post->increment('likes_count');

    return response()->json(['likes' => $post->likes_count], 200);
}

public function dislikePost(Request $request, $id)
{
    $post = Post::findOrFail($id);

    // Increment the dislikes count
    $post->increment('dislikes_count');

    return response()->json(['dislikes' => $post->dislikes_count], 200);
}
public function show($id)
{
    $post = Post::with('comments.user')->findOrFail($id);

    return view('posts.show', compact('post'));
}

public function toggleLike($id)
{
    $post = Post::findOrFail($id);

    $like = $post->likes()->where('user_id', auth()->id())->first();

    if ($like) {
        $like->delete(); // Unlike
    } else {
        $post->likes()->create(['user_id' => auth()->id()]);
    }

    return response()->json([
        'likes' => $post->likes->count(),
        'dislikes' => $post->dislikes->count()
    ]);
}


}

