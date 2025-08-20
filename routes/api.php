<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CategoryController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('events', EventController::class)->only(['index', 'show']);
Route::post('events/register', [RegistrationController::class, 'register']);
Route::apiResource('categories', CategoryController::class)->only('index');
