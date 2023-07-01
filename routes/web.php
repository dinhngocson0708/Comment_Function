<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/mas', [App\Http\Controllers\PageController::class,'getIndex']);
Route::get('/detail/{id}', [App\Http\Controllers\PageController::class,'getDetail']);

Route::get('/type/{id}', [App\Http\Controllers\PageController::class,'getLoaiSp']);

Route::get('/admin', [App\Http\Controllers\PageController::class, 'getIndexAdmin']);												
														
Route::get('/admin-add-form', [App\Http\Controllers\PageController::class, 'getAdminAdd'])->name('add-product');														
Route::post('/admin-add-form', [App\Http\Controllers\PageController::class, 'postAdminAdd']);												
Route::get('/admin-edit-form/{id}', [App\Http\Controllers\PageController::class, 'getAdminEdit']);
Route::post('/admin-edit', [App\Http\Controllers\PageController::class, 'postAdminEdit']);

																
Route::post('/admin-delete/{id}', [App\Http\Controllers\PageController::class, 'postAdminDelete'])->name('delete-product');


Route::post('/admin-export', [App\Http\Controllers\PageController::class, 'exportAdminProduct'])->name('export');

Route::get('/register', function () {return view('users.register');});
Route::post('/register',[App\Http\Controllers\UserController::class,'Register']);						

Route::get('/login', function () { return view('users.login');});	
Route::post('/login',[App\Http\Controllers\UserController::class,'login']);	

Route::get('/logout',[App\Http\Controllers\UserController::class,'logout']);	

													
Route::get('add-to-cart/{id}', [App\Http\Controllers\PageController::class, 'getAddToCart'])->name('themgiohang');												
Route::get('del-cart/{id}', [App\Http\Controllers\PageController::class, 'getDelItemCart'])->name('xoagiohang');												
                    
Route::post('/comment/{id}', [App\Http\Controllers\PageController::class, 'storeComments']);
