<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PermissionController;

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
    return view('frontend.welcome');
});

Auth::routes();

Route::get('/cms/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Backend Web Routes
|--------------------------------------------------------------------------
|
*/

// Route::get('/debug-routes', function () {
//     dd(Route::getRoutes());
// });
Route::middleware(['auth'])->prefix('/cms/post')->group(function () {
    Route::get('/list', [PostController::class, 'index'])->name('backend.post.index');
    Route::get('/create', [PostController::class, 'create'])->name('backend.post.create');
    Route::post('/store', [PostController::class, 'store'])->name('backend.post.store');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('backend.post.edit');
    Route::put('/update/{id}', [PostController::class, 'update'])->name('backend.post.update');
    Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('backend.post.delete');
    Route::get('/trash/list', [PostController::class, 'viewtrash'])->name('backend.post.viewtrash');
    Route::put('/movetotrash/{id}', [PostController::class, 'movetotrash'])->name('backend.post.movetotrash');
    Route::put('/restore/{id}', [PostController::class, 'restore'])->name('backend.post.restore');
    Route::put('/updatestatus/{id}', [PostController::class, 'updatestatus'])->name('backend.post.updatestatus')->middleware('auth');
});


Route::middleware(['auth'])->prefix('/cms/author')->group(function () {
    Route::get('/list', [AuthorController::class, 'index'])->name('backend.author.index');
    Route::get('/create', [AuthorController::class, 'create'])->name('backend.author.create');
    Route::post('/store', [AuthorController::class, 'store'])->name('backend.author.store');
    Route::get('/edit/{id}', [AuthorController::class, 'edit'])->name('backend.author.edit');
    Route::put('/update/{id}', [AuthorController::class, 'update'])->name('backend.author.update');
    Route::delete('/delete/{id}', [AuthorController::class, 'destroy'])->name('backend.author.delete');
    Route::get('/trash/list', [AuthorController::class, 'viewtrash'])->name('backend.author.viewtrash');
    Route::put('/movetotrash/{id}', [AuthorController::class, 'movetotrash'])->name('backend.author.movetotrash');
    Route::put('/restore/{id}', [AuthorController::class, 'restore'])->name('backend.author.restore');
    Route::put('/updatestatus/{id}', [AuthorController::class, 'updatestatus'])->name('backend.author.updatestatus');
});


Route::middleware(['auth'])->prefix('/cms/category')->group(function () {
    Route::get('/list', [CategoryController::class, 'index'])->name('backend.category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('backend.category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('backend.category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('backend.category.edit');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('backend.category.update');
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('backend.category.delete');
    Route::get('/trash/list', [CategoryController::class, 'viewtrash'])->name('backend.category.viewtrash');
    Route::put('/movetotrash/{id}', [CategoryController::class, 'movetotrash'])->name('backend.category.movetotrash');
    Route::put('/restore/{id}', [CategoryController::class, 'restore'])->name('backend.category.restore');
    Route::put('/updatestatus/{id}', [CategoryController::class, 'updatestatus'])->name('backend.category.updatestatus');
});


Route::middleware(['auth'])->prefix('/cms/tag')->group(function () {
    Route::get('/list', [TagController::class, 'index'])->name('backend.tag.index');
    Route::post('/store', [TagController::class, 'store'])->name('backend.tag.store');
    Route::delete('/delete/{id}', [TagController::class, 'destroy'])->name('backend.tag.delete');
});


Route::middleware(['auth'])->prefix('/cms/user')->group(function () {
    Route::get('/list', [UserController::class, 'index'])->name('backend.user.index');
    Route::get('/create', [UserController::class, 'create'])->name('backend.user.create');
    Route::post('/store', [UserController::class, 'store'])->name('backend.user.store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('backend.user.edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('backend.user.update');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('backend.user.delete');
    Route::get('/trash/list', [UserController::class, 'viewtrash'])->name('backend.user.viewtrash');
    Route::put('/movetotrash/{id}', [UserController::class, 'movetotrash'])->name('backend.user.movetotrash');
    Route::put('/restore/{id}', [UserController::class, 'restore'])->name('backend.user.restore');
    Route::put('/updatestatus/{id}', [UserController::class, 'updatestatus'])->name('backend.user.updatestatus');
});


Route::get('/cms/permission/list', PermissionController::class)->name('backend.permission.index')->middleware('auth');


Route::middleware(['auth'])->prefix('/cms/role')->group(function () {
    Route::get('/list', [RoleController::class, 'index'])->name('backend.role.index');
    Route::get('/create', [RoleController::class, 'create'])->name('backend.role.create');
    Route::post('/store', [RoleController::class, 'store'])->name('backend.role.store');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('backend.role.edit');
    Route::put('/update/{id}', [RoleController::class, 'update'])->name('backend.role.update');
    Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('backend.role.delete');
});


Route::middleware(['auth'])->prefix('/cms/page')->group(function () {
    Route::get('/list', [PageController::class, 'index'])->name('backend.page.index');
});
