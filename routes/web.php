<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('front.index');
});

Route::get('admin/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    $recentBlogs = \App\Models\Blog::where('status', '1')
                          ->orderBy('created_at', 'desc')
                        //   ->take(5)
                          ->paginate(5);

    // $recentUsers = \App\Models\User::orderBy('created_at', 'desc')
    //                       ->take(5)
    //                       ->get();

    return view('dashboard', compact('recentBlogs'));
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
