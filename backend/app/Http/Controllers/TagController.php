<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $posts = Tag::paginate(10);

        return response()->json($posts);
    }

    public function store(TagRequest $request)
    {
        Tag::create([
            'content' => $request->content,
            'user_id' => 1,
        ]);

        return response()->json(['message' => 'Tag created successfully']);
    }

    public function show(Tag $tag)
    {
        abort_if(!$tag, 404, response()->json(['message' => 'Tag not found']));

        return response()->json($tag);
    }

    public function update(TagRequest $request, Tag $tag)
    {
        if ($request->user()->cannot('delete', $tag)) {
            abort(403);
        }

        $tag->update($request->validated());

        return response()->json(['message' => 'Tag updated successfully']);
    }

    public function destroy(Request $request, Tag $tag)
    {
        if ($request->user()->cannot('delete', $tag)) {
            abort(403);
        }

        abort_if(!$tag, 404, response()->json(['message' => 'Tag not found']));

        $tag->delete();

        return response()->json(['message' => 'Tag deleted successfully']);
    }
}
