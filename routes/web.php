<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Student\StudentController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/events/create', [AdminController::class, 'create'])->name('events.create');
    Route::post('/events', [AdminController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [AdminController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [AdminController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [AdminController::class, 'destroy'])->name('events.destroy');
    Route::get('/events/{event}/students', [AdminController::class, 'students'])->name('events.students');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/events', [StudentController::class, 'index'])->name('events');
    Route::post('/events/{event}/register', [StudentController::class, 'registerForEvent'])->name('events.register');
    Route::delete('/events/{event}/unregister', [StudentController::class, 'unregisterFromEvent'])->name('events.unregister');
});
