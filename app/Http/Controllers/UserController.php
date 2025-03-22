<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
   public function index(){
    $users = User::latest()->get();
    return view('admin.user.index',compact('users'));

   }

   public function create(){
    return view('admin.user.form');
   }


   public function store(Request $request)
   {
    $request->validate([
        'name' => 'required',
        'email' => 'required|string',
        'password' =>'required',
        'role' => 'required'
    ]);
    DB::beginTransaction();
    try{
        // User::create($request->all());
        User::create([
            'name' =>$request->name,
            'email' => $request->email,
            'password'=> bcrypt($request->password),
            'status' =>$request->status,
            'role' =>$request->role,

        ]);
        DB::commit();
        return redirect()->route('user.index')->with('success', 'User Created Successfully');

    }
    catch(\Throwable $th){
        DB::rollBack();
        return back()->with('error','Something Went Wrong :'.$th->getMessage());
    }



   }

   public function edit($id)
   {
    $user = User::findOrFail($id);
    return view('admin.user.form',compact('user'));
   }

   public function update(Request $request, $id)
   {
    $request->validate([
        'name' => 'required',
        'email' => 'required|string',
        'password' =>'nullable',
        'role' => 'required'

    ]);

    DB::beginTransaction();
    try{
        $user = User::findOrFail($id);
        //  $user->update($request->all());
        $user->update([
            'name' =>$request->name,
            'email' => $request->email,
            'password'=> bcrypt($request->password),
            'status' =>$request->status ,
            'role' =>$request->role,

        ]);
         DB::commit();
        return redirect()->route('user.index')->with('success', 'User Updated Successfully');

    }
    catch(\Throwable $th){
        DB::rollBack();
        return back()->with('error','Something Went Wrong :'.$th->getMessage());

    }
   }


   public function destroy($id)
{
    DB::beginTransaction();
    try {
        $user = User::findOrFail($id);
        $user->delete();

        DB::commit();
        return redirect()->back()->with('success', 'User Deleted Successfully');
    } catch (\Throwable $th) {
        DB::rollBack();
        return back()->with('error', 'Something Went Wrong: ' . $th->getMessage());
    }
}


public function changestatus(Request $request, $id)
    {

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            if (!$user) {
                $response = [
                    'error' => true,
                    'message' => 'user not found'
                ];
                return response()->json($response, 404);
            }
            $user->status = $request->status;
            $user->save();
            DB::commit();
            $response = [
                'status' => true,
                'message' => 'Successfully updated',
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'status' => false,
                'message' => 'something went wrong :' . $th->getMessage()
            ];
        }
    }

    public function forceDelete($id)
{
    DB::beginTransaction();
    try {
        $user = User::withTrashed()->findOrFail($id);

        $user->forceDelete(); 

        DB::commit();
        return redirect()->back()->with('success', 'User permanently deleted');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

public function restore($id)
{
    DB::beginTransaction();
    try {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
        }

        DB::commit();
        return redirect()->route('user.index')->with('success', 'User restored successfully');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

    public function backup() {
        $deleteduser = User::onlyTrashed()->get();

        $deletedBlogs = Blog::onlyTrashed()->get();
        $deletedcategory = Category::onlyTrashed()->get();

        return view('admin.backup.index', compact('deleteduser', 'deletedBlogs','deletedcategory'));
    }


}
