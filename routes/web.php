<?php
// use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index']);
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/register', [EventController::class, 'register'])->name('events.register');
