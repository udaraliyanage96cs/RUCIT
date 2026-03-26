<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventRegistrationController;

// Public event listing
Route::get('/events', [APIController::class, 'getData']);
Route::get('/event/{id}', [APIController::class, 'event']);

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::get('/profile',  [AuthController::class, 'profile']);
    Route::post('/logout',  [AuthController::class, 'logout']);

    // Event CRUD (admin)
    Route::post('/create',        [APIController::class, 'store']);
    Route::put('/update/{id}',    [APIController::class, 'update']);
    Route::delete('/delete/{id}', [APIController::class, 'delete']);

    // Event registrations
    Route::post('/events/join',   [EventRegistrationController::class, 'join']);
    Route::delete('/events/leave/{event_id}',             [EventRegistrationController::class, 'leave']);
    Route::get('/my-events',                              [EventRegistrationController::class, 'myEvents']);
    Route::get('/events/{event_id}/registrations',        [EventRegistrationController::class, 'eventRegistrations']);
});
