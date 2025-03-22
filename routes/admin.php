<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::group(['middleware' => ['web', 'admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::get('dashboard', function () {
    $total_user = \App\Models\User::count();
    $total_blogs = \App\Models\Blog::count();
    $total_categories = \App\Models\Category::count();


    return view('admin.index', compact('total_user', 'total_blogs', 'total_categories'));
})->name('admin.dashboard');




Route::resource('user', UserController::class);
Route::post('user/change-status/{id}', [UserController::class, 'changestatus']);
Route::delete('/user/{id}/force-delete', [UserController::class, 'forceDelete'])->name('user.forceDelete');
Route::post('/user/{id}/restore', [UserController::class, 'restore'])->name('user.restore');

Route::resource('category', CategoryController::class);
Route::post('category/change-status/{id}', [CategoryController::class, 'changestatus']);
Route::delete('/category/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('category.forceDelete');
Route::post('/category/{id}/restore', [CategoryController::class, 'restore'])->name('category.restore');

Route::resource('blog', BlogController::class);
Route::post('blog/change-status/{id}', [BlogController::class, 'changestatus']);
Route::delete('/blog/{id}/force-delete', [BlogController::class, 'forceDelete'])->name('blog.forceDelete');
Route::post('/blog/{blog}/restore', [BlogController::class, 'restore'])->name('blog.restore');


Route::get('backup', [UserController::class, 'backup'])->name('backup.service');



