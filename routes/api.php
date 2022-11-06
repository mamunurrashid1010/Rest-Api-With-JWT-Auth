<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

# auth
Route::group(['middleware'=>'api','prefix'=>'auth'],function ($router){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::get('/profile',[AuthController::class,'profile']);
    Route::post('/logout',[AuthController::class,'logout']);
});

# departments
Route::group(['middleware'=>'api','prefix'=>'department'],function ($router){
    Route::post('/store',[DepartmentsController::class,'store']);
});
