<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BlogApiController extends Controller
{

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Wrong credentials'], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'msg' => 'Login Successfully',
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong!', 'error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        try {
            $blogs = Blog::with('category')->get();

            $data =[
                'error' => false,
                'message' => 'Successfully fetched all blogs',
                'data' => $blogs
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong!', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $blog = Blog::with('category')->find($id);

            if (!$blog) {
                return response()->json(['message' => 'Blog not found'], 404);
            }

            $data =[
                'error' => false,
                'message' => "successfully fetched",
                'data' => $blog
            ];

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong!', 'error' => $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'slug' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'user_id' => Auth::id() ?? 1,
            'status' => $request->status ?? 1
        ]);

        return response()->json([
            'error' => false,
            'message' => 'Blog created successfully!',
            'blog' => $blog
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong!',
            'error' => $e->getMessage()
        ], 500);
    }
}


public function update(Request $request, $id)
{
    try {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $request->validate([
            'title' => 'required|string',
            'slug' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $blog->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $request->image ? $request->image->store('images') : $blog->image,
            'category_id' => $request->category_id,
        ]);

        $data = [
            'error' => false,
            'message' => 'Successfully updated',
            'data' => $blog
        ];

        return response()->json($data , 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Something went wrong!', 'error' => $e->getMessage()], 500);
    }
}

public function destroy($id)
{
    try {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $blog->delete();
        return response()->json(['message' => 'Blog deleted successfully'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Something went wrong!', 'error' => $e->getMessage()], 500);
    }
}

public function getcategory()
{
    try {
        $categories = Category::all();
        $data =[
            'error' => false,
            'message' => 'All Category Fetched',
            'data' => $categories
        ];
        return response()->json($data, 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Something went wrong!', 'error' => $e->getMessage()], 500);
    }
}

public function categorystore(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'status' => 'required|in:active,inactive',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ]);

        return response()->json($category, 201);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Something went wrong!', 'error' => $e->getMessage()], 500);
    }
}

public function categoryupdate(Request $request, $id)
{
    try {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'status' => 'required|in:active,inactive',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ]);

        return response()->json($category, 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Something went wrong!', 'error' => $e->getMessage()], 500);
    }
}

public function categorydestroy($id)
{
    try {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Something went wrong!', 'error' => $e->getMessage()], 500);
    }
}
}

