<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::controller(AuthController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->middleware(['auth:sanctum']);
});

Route::middleware('auth:sanctum')
    ->controller(CategoryController::class)
    ->group(function() {
        Route::get('/category/list', 'list');
        Route::post('/category/add', 'add');
        Route::post('/category/edit', 'edit');
        Route::get('/category/del', 'delete');
    });

Route::middleware('auth:sanctum')
    ->controller(BookController::class)
    ->group(function() {
        Route::get('/book/list', 'list');
        Route::post('/book/add', 'add');
        Route::post('/book/edit', 'edit');
        Route::get('/book/del', 'delete');
    });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
