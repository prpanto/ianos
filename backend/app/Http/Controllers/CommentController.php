<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post)
    {
        abort_if(!$post, 404, 'Post not found');

        Comment::create([
            'content' => $request->content,
            'user_id' => 1,
        ]);

        return response()->json(['message' => 'Comment created successfully']);
    }

    public function show(Post $post, Comment $comment)
    {
        abort_if(!$post, 404, 'Post not found');
        abort_if(!$comment, 404, 'Comment not found');

        return response()->json($comment);
    }

    public function update(CommentRequest $request, Post $post, Comment $comment)
    {
        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }

        abort_if(!$post, 404, 'Post not found');

        $comment->update($request->validated());

        return response()->json(['message' => 'Comment updated successfully']);
    }

    public function destroy(Request $request, Post $post, Comment $comment)
    {
        if ($request->user()->cannot('delete', $comment)) {
            abort(403);
        }

        abort_if(!$post, 404, 'Post not found');
        abort_if(!$comment, 404, 'Comment not found');

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
