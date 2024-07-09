<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AppointmentController;

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

// Route that requires authentication (example)

// User registration endpoint
Route::post('/register', [RegisteredUserController::class, 'store']);

// User login endpoint
Route::POST('/login-api', [AuthenticatedSessionController::class, 'store']);

//func
Route::get('/getAppointments', [AppointmentController::class, 'index']);

// Route for creating a new appointment
Route::post('/appointments', [AppointmentController::class, 'appoint']);

// Route for creating a walk-in appointment
Route::post('/walkin', [AppointmentController::class, 'walkin']);

// Route for accepting an appointment
Route::put('/appointments/{id}/accept', [AppointmentController::class, 'accept']);

// Route for cancelling an appointment
Route::put('/appointments/{id}/cancel', [AppointmentController::class, 'cancel']);

// Route for declining an appointment
Route::put('/appointments/{id}/decline', [AppointmentController::class, 'decline']);

// Route for deleting an appointment
Route::delete('/appointments/{id}', [AppointmentController::class, 'delete']);
