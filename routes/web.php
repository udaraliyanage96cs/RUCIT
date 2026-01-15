<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create_event',[EventController::class,'createEvent']);

Route::get('/get_events',[EventController::class,'getEvents']);
Route::get('/event/{id}',[EventController::class,'getEvent']);

Route::get('/update/{id}',[EventController::class,'updateEvent']);
Route::get('/delete/{id}',[EventController::class,'deleteEvent']);