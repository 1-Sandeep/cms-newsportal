<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\AuthorController;

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
    Route::put('/updatestatus/{id}', [PostController::class, 'updatestatus'])->name('backend.post.updatestatus')->middleware('auth');
});



// Author
Route::middleware(['auth'])->prefix('/cms/author')->group(function () {
    Route::get('/list', [AuthorController::class, 'index'])->name('backend.author.index');
    Route::get('/create', [AuthorController::class, 'create'])->name('backend.author.create');
    Route::post('/store', [AuthorController::class, 'store'])->name('backend.author.store');
    Route::get('/edit/{id}', [AuthorController::class, 'edit'])->name('backend.author.edit');
    Route::put('/update/{id}', [AuthorController::class, 'update'])->name('backend.author.update');
    Route::delete('/delete/{id}', [AuthorController::class, 'destroy'])->name('backend.author.delete');
    Route::put('/movetotrash/{id}', [AuthorController::class, 'movetotrash'])->name('backend.author.movetotrash');
    Route::get('/trash/list', [AuthorController::class, 'viewtrash'])->name('backend.author.viewtrash');
    Route::put('/restore/{id}', [AuthorController::class, 'restore'])->name('backend.author.restore');
    Route::put('/updatestatus/{id}', [AuthorController::class, 'updatestatus'])->name('backend.author.updatestatus')->middleware('auth');
});
