<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FileController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('file')->group(function () {
    Route::post('/', [FileController::class, 'upload']);
    Route::delete('/', [FileController::class, 'delete']);
});

Route::prefix('admin/posts')->group(function () {
    Route::get('getter', [PostController::class, 'getter']);
    Route::get('/', [PostController::class, 'get']);
    Route::post('/', [PostController::class, 'add']);
    Route::put('/{id}', [PostController::class, 'update']);
    Route::delete('/many', [PostController::class, 'removeMany']);
    Route::delete('/{id}', [PostController::class, 'remove']);
});