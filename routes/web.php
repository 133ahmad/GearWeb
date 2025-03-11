<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MechanicController;

Route::prefix('api')->group(function() {
    // Customer Routes
    Route::resource('customers', CustomerController::class);

    // Mechanic Routes
    Route::resource('mechanics', MechanicController::class);
});

Route::get('/', function () {
    return view('welcome');
});
