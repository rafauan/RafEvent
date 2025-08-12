<?php
// use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
})->name('welcome');

Route::get('/register-confirmation', function () {
    return view('registration.confirmation');
})->name('register.confirmation');

// Route::get('/', [EventController::class, 'index']);
// Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
// Route::post('/events/register', [EventController::class, 'register'])->name('events.register');
// Route::post('/events/register', function () {
//     return 'Test';
// });
