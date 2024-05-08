<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified', 'user'])
    ->name('dashboard');

// Dashboard route for admin

Route::get('/admin', function () {
    return view('admin');
})
    ->middleware(['auth', 'verified', 'admin'])
    ->name('admin');

// Dashboard route for Super admin

Route::get('/superadmin', function () {
    return view('superadmin');
})
    ->middleware(['auth', 'verified', 'superadmin'])
    ->name('superadmin');

// Resource full Routes for TasksController
Route::get('user/task/{id}', [\App\Http\Controllers\TaskController::class, 'index'])->name('user.tasks');
Route::post('create/task', [\App\Http\Controllers\TaskController::class, 'store'])->name('create.task');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
