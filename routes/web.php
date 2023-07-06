<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
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
//User Resource
Route::get('/',function(){
        return view('users.login');
});
Route::get('/users/logout',[UsersController::class,'logout']);

Route::post('/users/login',[UsersController::class,'login']);
Route::get('/users/register',[UsersController::class,'create']);
Route::post('/users/store',[UsersController::class,'store']);



//Product Resource
Route::group(['middleware' => ['Login']], function () {
    Route::resource('users', UsersController::class)->middleware('Admin');
    Route::post('users/{id}', [UsersController::class,'update'])->middleware('Admin');
    Route::get('users/delete/{id}', [UsersController::class,'destroy'])->middleware('Admin');
    
    Route::resource('products', ProductsController::class);
    Route::post('products/{id}', [ProductsController::class,'update'])->middleware('Admin');
    Route::get('products/delete/{id}', [ProductsController::class,'destroy'])->middleware('Admin');
});