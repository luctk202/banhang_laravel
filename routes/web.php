<?php

use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
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
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->name('dashboard');
Route::get('/home', function () {
    return view('client.layouts.app');
});
Auth::routes();
Route::resource('roles',RoleController::class);
Route::resource('users',UserController::class);
Route::resource('categories',CategoryController::class);
Route::resource('products',ProductController::class);
//Route::resource('categories',CategoryController::class);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/list-category',[CategoryController::class, 'list_category'])->name('list-category');
//Route::post('/list-category',[CategoryController::class, 'list_category'])->name('search-category');
//Route::get('/list-user',[UserController::class, 'list_user'])->name('list-user');
//Route::match(['GET','POST'],'/add/user',[UserController::class,'add'])->name('add-user');
//Route::match(['GET','POST'],'/add/category',[CategoryController::class,'add'])->name('add-category');
//Route::match(['GET','POST'],'/edit/category/{id}',[CategoryController::class,'edit'])->name('edit-category');

