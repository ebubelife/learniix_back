<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProductsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::controller(MembersController::class)->group(function(){
    Route::post('signup', 'store');
    Route::post('login', 'login');
    Route::post('verify_email_otp', 'verify_email_otp');
    Route::post('send_email', 'send_email');
    Route::get('test','test');
    Route::post('addVendor','createVendor');
   // Route::middleware('auth:sanctum')-> post('set_transaction_pin','set_transaction_pin');
   
   // Route::get('test_api','test_api');
});

Route::controller(VendorsController::class)->group(function(){
  
    Route::post('vendors/create','store');
   // Route::middleware('auth:sanctum')-> post('set_transaction_pin','set_transaction_pin');
   
   // Route::get('test_api','test_api');
});

Route::controller(ProductsController::class)->group(function(){
  
    Route::post('products/add','store');
   // Route::middleware('auth:sanctum')-> post('set_transaction_pin','set_transaction_pin');
   
   // Route::get('test_api','test_api');
});


