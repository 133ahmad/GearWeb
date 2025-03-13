<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Customer;
use App\Models\Mechanic;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\EmergencyRequestController;



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


use App\Http\Controllers\Api\ServiceRequestController;

Route::get('service-requests', [ServiceRequestController::class, 'index']);
Route::post('service-requests', [ServiceRequestController::class, 'store']);
Route::get('service-requests/{id}', [ServiceRequestController::class, 'show']);
Route::put('service-requests/{id}', [ServiceRequestController::class, 'update']);
Route::delete('service-requests/{id}', [ServiceRequestController::class, 'destroy']);
Route::post('/emergency/request', [EmergencyRequestController::class, 'findNearestMechanic']);


