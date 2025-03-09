<?php

use App\Http\Controllers\TherapistController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/best-therapists', [TherapistController::class, 'bestTherapists'])->name('best-therapists');
Route::get('/therapists', [TherapistController::class, 'index'])->name('therapists.index');


Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/number-of-users-registered-today', [UserController::class, 'numberOfUsersRegisteredToday'])->name('users.numberOfUsersRegisteredToday');
});
