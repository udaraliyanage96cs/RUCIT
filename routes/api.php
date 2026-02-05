<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/events',[APIController::class,'getData']);
Route::post('/create',[APIController::class,'store']);
Route::put('/update/{id}',[APIController::class,'update']);

Route::delete('/delete/{id}',[APIController::class,'delete']);
Route::get('/event/{id}',[APIController::class,'event']);

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/profile', [AuthController::class,'profile']);
    Route::post('/logout',[AuthController::class,'logout']);
});