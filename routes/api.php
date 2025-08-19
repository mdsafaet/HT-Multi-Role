<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;


Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {



    Route::post('login',[AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
     Route::post('me', [AuthController::class,'me']);


});

 Route::post('/register', [AuthController::class,'register']);



Route::middleware(['role:admin,user,super admin' ,'auth:api'])->group(function ($router) {


Route::put('/update/{id}', [AuthController::class,'update']);
Route::delete('/delete/{id}', [AuthController::class,'destroy']);

 

  Route::apiResource('project', ProjectController::class);

Route::apiResource('task', TaskController::class);
Route::apiResource('tag', TagController::class);



});




