<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API_Product1_Controller;
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
Route::middleware('auth:api')->get('/user', function (Request $request) {							
	return $request->user();							
	});							
							
// create api						
Route::get('/get-product',[App\Http\Controllers\APIController::class,'getProducts']);	
									
Route::get('/get-product/{id}', [App\Http\Controllers\APIController::class,'getOneProduct']);								
Route::post('/add-product',[App\Http\Controllers\APIController::class,'addProduct']);								
Route::delete('/delete-product/{id}',[App\Http\Controllers\APIController::class,'deleteProduct']);								
Route::put('/edit-product/{id}',[App\Http\Controllers\APIController::class,'editProduct']);								
                                
							

//API PRODUCT1:

Route::get('/getProduct_one',[App\Http\Controllers\API_Product1_Controller::class,'getProduct1']);
Route::post('/add-product_one',[App\Http\Controllers\API_Product1_Controller::class,'addproduct1']);
Route::post('/upload-image',[App\Http\Controllers\API_Product1_Controller::class,'uploadImage']);													
