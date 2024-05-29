<?php

use App\Http\Controllers\Backend\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/cms/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Backend Web Routes
|--------------------------------------------------------------------------
|
*/
// Post 
Route::middleware(['auth'])->prefix('/cms/post')->group(function () {
    Route::get('/list', [PostController::class, 'index'])->name('backend.post.index');
    Route::get('/create', [PostController::class, 'create'])->name('backend.post.create');
    Route::post('/store', [PostController::class, 'store'])->name('backend.post.store');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('backend.post.edit');
    Route::put('/update/{id}', [PostController::class, 'update'])->name('backend.post.update');
    Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('backend.post.delete');
    Route::put('/movetotrash/{id}', [PostController::class, 'movetotrash'])->name('backend.post.movetotrash');
    Route::get('/trash/list', [PostController::class, 'viewtrash'])->name('backend.post.viewtrash');
    Route::put('/restore/{id}', [PostController::class, 'restore'])->name('backend.post.restore');
});

Route::put('/updatestatus/{id}', [PostController::class, 'updatestatus'])->name('backend.post.updatestatus')->middleware('auth');
