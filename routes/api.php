<?php

use App\Http\Controllers\BlogApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/blogs', [BlogApiController::class, 'index']);

    Route::get('/blog/{id}', [BlogApiController::class, 'show']);

    Route::post('/blog', [BlogApiController::class, 'store']);

    Route::put('/blog/{id}', [BlogApiController::class, 'update']);

    Route::delete('/blog/{id}', [BlogApiController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
