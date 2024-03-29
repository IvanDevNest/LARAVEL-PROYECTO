<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\PlaceController;

use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\PostController;


 
Route::apiResource('files', FileController::class);
Route::post('files/{file}', [FileController::class, 'update_workaround']);

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [TokenController::class, 'register']);
Route::post('/login', [TokenController::class, 'login']);
Route::post('/logout', [TokenController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [TokenController::class, 'user'])->middleware('auth:sanctum');

Route::apiResource('post',PostController::class);

Route::post('/post/{post}',[PostController::class,'store'])->middleware('auth:sanctum');

Route::post('/post/{post}/likes',[PostController::class, 'like']);
Route::delete('/post/{post}/likes',[PostController::class, 'unlike']);

Route::apiResource('places',PlaceController::class);


Route::post('/places/{place}/favorites', [PlaceController::class,'favorite']);
Route::delete('/places/{place}/favorites', [PlaceController::class,'unfavorite']);



