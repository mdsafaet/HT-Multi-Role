<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {



    Route::post('login',[AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
});

Route::post('/register', [AuthController::class,'register']);
Route::put('/update/{id}', [AuthController::class,'update']);
Route::delete('/delete/{id}', [AuthController::class,'destroy']);
