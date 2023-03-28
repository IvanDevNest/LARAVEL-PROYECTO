<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PlaceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function (Request $request) {
    $message = 'Loading welcome page';
    Log::info($message);
    $request->session()->flash('info', $message);
    return view('welcome');
 });
 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sobrenosotros', function () {
   return view('sobrenosotros');
})->middleware(['auth', 'verified'])->name('sobrenosotros');

Route::get('/contacto', function () {
   return view('contacto');
})->middleware(['auth', 'verified'])->name('contacto');

Route::get('mail/test', [MailController::class, 'test']);




require __DIR__.'/auth.php';


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resource('files', FileController::class)
   ->middleware(['auth', 'permission:files']);

Route::get('/posts/prueba', [PostController::class, 'prueba'])->name('posts.prueba');

Route::resource('posts', PostController::class)
->middleware(['auth', 'permission:posts']);

Route::resource('places', PlaceController::class)
   ->middleware(['auth', 'permission:places']);


Route::get('/language/{locale}', [App\Http\Controllers\LanguageController::class, 'language']);

Route::post('/posts/{post}/likes',[App\Http\Controllers\PostController::class, 'like'])->name('posts.like');

Route::delete('/posts/{post}/likes',[App\Http\Controllers\PostController::class, 'unlike'])->name('posts.unlike');
Route::post('/places/{place}/favorites', [App\Http\Controllers\PlaceController::class, 'favorite'])->name('place.favorite');

Route::delete ('/places/{place}/favorites', [App\Http\Controllers\PlaceController::class, 'unfavorite'])->name('place.unfavorite');
