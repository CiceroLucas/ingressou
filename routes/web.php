<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PublicEventController::class, 'index'])->name('home');
Route::get('/events/{event}', [PublicEventController::class, 'show'])->name('events.show');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Registration Routes
    Route::post('/events/{event}/register', [RegistrationController::class, 'store'])->name('events.register');
    Route::delete('/events/{event}/register', [RegistrationController::class, 'destroy'])->name('events.unregister');

    // User Tickets Routes
    Route::get('/my-tickets', [\App\Http\Controllers\UserTicketController::class, 'index'])->name('profile.tickets');
    Route::get('/my-tickets/{registration}', [\App\Http\Controllers\UserTicketController::class, 'show'])->name('profile.ticket-show');
});

// Admin Routes
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    // Scanner routes
    Route::get('/scanner', [EventController::class, 'scanner'])->name('scanner');
    Route::get('/validate-ticket/{ticket_code}', [EventController::class, 'validateTicket'])->name('validate-ticket');

    Route::resource('events', EventController::class)->except(['show']);
    Route::get('events/{event}/registrations', [EventController::class, 'registrations'])->name('events.registrations');
});

require __DIR__.'/auth.php';
