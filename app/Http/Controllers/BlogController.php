<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::where('status', true)->get();
        return view('admin.blogs.form',compact('categories'));
    }

    public function store(BlogRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($request->title);
            $data['user_id'] = auth()->id();
            Blog::create($data);
            DB::commit();
            return redirect()->route('blog.index')->with('success', 'Blog created successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    public function edit(Blog $blog)
    {
        $categories = Category::where('status', true)->get();

        return view('admin.blogs.form', compact('blog','categories'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($request->title);
           $blog->update($data);
            DB::commit();
            return redirect()->route('blog.index')->with('success', 'Blog updated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    public function destroy(Blog $blog)
    {
        DB::beginTransaction();
        try {
            $blog->delete();
            DB::commit();
            return redirect()->route('blog.index')->with('success', 'Blog deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }


    public function forceDelete($id)
{
    DB::beginTransaction();
    try {
        $Blog = Blog::withTrashed()->findOrFail($id);

        $Blog->forceDelete();

        DB::commit();
        return redirect()->back()->with('success', 'Blog permanently deleted');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

public function restore($id)
{
    DB::beginTransaction();
    try {
        $Blog = Blog::withTrashed()->find($id);
        if ($Blog) {
            $Blog->restore();
        }

        DB::commit();
        return redirect()->route('blog.index')->with('success', 'Blog restored successfully');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

    public function changeStatus(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $blog = Blog::findOrFail($id);
            $blog->status = $request->status;
            $blog->save();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Successfully updated'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong: ' . $th->getMessage()], 500);
        }
    }
}
