<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        DB::beginTransaction();
        try {
            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'status' => $request->status ?? 0,
            ]);

            DB::commit();
            return redirect()->route('category.index')->with('success', 'Category created successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        DB::beginTransaction();
        try {
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'status' => $request->status ?? 0,
            ]);

            DB::commit();
            return redirect()->route('category.index')->with('success', 'Category updated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            $category->delete();

            DB::commit();
            return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    public function changestatus(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);

            $category->status = $request->status;
            $category->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Category status updated successfully.',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $th->getMessage(),
            ], 500);
        }
    }


    public function forceDelete($id)
{
    DB::beginTransaction();
    try {
        $category = Category::withTrashed()->findOrFail($id);

        $category->forceDelete();

        DB::commit();
        return redirect()->back()->with('success', 'Category permanently deleted');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

public function restore($id)
{
    DB::beginTransaction();
    try {
        $category = Category::withTrashed()->find($id);
        if ($category) {
            $category->restore();
        }

        DB::commit();
        return redirect()->route('category.index')->with('success', 'Category restored successfully');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}
}
