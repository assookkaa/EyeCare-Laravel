<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\MedicalRecords;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CheckupController;
use App\Http\Controllers\RatingsController;
use Illuminate\Support\Facades\Route;
use \App\Models\User;
use \App\Models\Ratings;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $patientsCount = User::where('usertype', 'patient')->count();
    $ratings = Ratings::pluck('rate')->toArray();
    $ratingsCount = count($ratings); 
    $averageRating = $ratingsCount > 0 ? array_sum($ratings) / $ratingsCount : 0;
    $reviews = Ratings::orderBy('id', 'desc')->with('appointment.user')->limit(6)->get();

    return view('welcome', compact('patientsCount', 'averageRating', 'ratingsCount', 'reviews'));
})->middleware('guest', 'prev_back');

Route::middleware('auth', 'admin', 'prev_back')->group(function () {
    Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment');
    Route::post('/appointment/walk-in', [AppointmentController::class, 'walkin'])->name('appointment-walkin');
    Route::put('/appointment/{id}/accept', [AppointmentController::class, 'accept'])->name('appointment.accept');
    Route::put('/appointment/{id}/decline', [AppointmentController::class, 'decline'])->name('appointment.decline');
    Route::put('/appointment/{id}/delete', [AppointmentController::class, 'delete'])->name('appointment.delete');

    Route::get('/check-up', [CheckupController::class, 'index'])->name('checkup');
    Route::post('/walk-in/check-up', [CheckupController::class, 'wstore'])->name('wcheckup');
    Route::post('/check-up/result', [CheckupController::class, 'store'])->name('result');

    Route::get('/users', [UserManagement::class, 'index'])->name('users');
    Route::post('/add-user', [UserManagement::class, 'add_user'])->name('add.user');
    Route::get('/user/{id}/general-settings', [UserManagement::class, 'general_settings'])->name('general_settings');
    Route::post('/user/{id}/update', [UserManagement::class, 'update'])->name('update.user');
    Route::post('/user/{id}/update-security', [UserManagement::class, 'update_sec'])->name('update.user-sec');
    Route::put('/user/{id}/activate', [UserManagement::class, 'activate'])->name('users.activate');
    Route::put('/user/{id}/deactivate', [UserManagement::class, 'deactivate'])->name('users.deactivate');

    Route::get('/medical-records', [MedicalRecords::class, 'index'])->name('records');
    Route::get('/medical-records/records-of/{id}', [MedicalRecords::class, 'records_of'])->name('records_of');
});

Route::middleware('auth', 'patient', 'prev_back')->group(function () {
    Route::post('/appointment/appoint', [AppointmentController::class, 'appoint'])->name('appoint');
    Route::put('/appointment/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointment.cancel');
    
    Route::get('/records', [MedicalRecords::class, 'patient_records'])->name('patient_records');
    Route::get('/history', [MedicalRecords::class, 'patients_history'])->name('patients_history');

    Route::post('/rating', [RatingsController::class, 'store'])->name('rating.store');
});

Route::middleware('auth', 'prev_back')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
