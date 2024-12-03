<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Validate the request
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        // Create the comment
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
    public function destroy($id)
{
    $comment = Comment::findOrFail($id);

    // Check if the comment belongs to the authenticated user
    if ($comment->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'You can only delete your own comments.');
    }

    $comment->delete();

    return redirect()->back()->with('success', 'Comment deleted successfully.');
}

}
