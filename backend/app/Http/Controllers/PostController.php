<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::paginate($request->per_page ?? 10);

        return response()->json($posts);
    }

    public function store(PostRequest $request)
    {
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => 1,
        ]);

        return response()->json(['message' => 'Post created successfully']);
    }

    public function show(Post $post)
    {
        abort_if(!$post, 404, response()->json(['message' => 'Post not found']));

        $comments = $post->comments;

        return response()->json(['post' => $post, 'comments' => $comments]);
    }

    public function update(PostRequest $request, Post $post)
    {
        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }

        $post->update($request->validated());

        return response()->json(['message' => 'Post updated successfully']);
    }

    public function destroy(Request $request, Post $post)
    {
        if ($request->user()->cannot('delete', $post)) {
            abort(403);
        }

        abort_if(!$post, 404, response()->json(['message' => 'Post not found']));

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
