<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogApiController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user', 'category')->get();

        return response()->json($blogs, 200);
    }

    public function show($id)
    {
        $blog = Blog::with('user', 'category')->find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        return response()->json($blog, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs',
            'content' => 'required|string',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'image' => $request->image ? $request->image->store('images') : null,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        return response()->json($blog, 201);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $id,
            'content' => 'required|string',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $blog->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'image' => $request->image ? $request->image->store('images') : $blog->image,
            'category_id' => $request->category_id,
        ]);

        return response()->json($blog, 200);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $blog->delete();

        return response()->json(['message' => 'Blog deleted successfully'], 200);
    }
}
