<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequestController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Procurement Requests Routes
    Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/create', [RequestController::class, 'create'])->name('requests.create')->middleware('role:staff');
    Route::post('/requests', [RequestController::class, 'store'])->name('requests.store')->middleware('role:staff');
    Route::get('/requests/{id}', [RequestController::class, 'show'])->name('requests.show');

    // Approval Routes
    Route::post('/requests/{id}/approve', [RequestController::class, 'approve'])->name('requests.approve')->middleware('role:manager');
    Route::post('/requests/{id}/reject', [RequestController::class, 'reject'])->name('requests.reject')->middleware('role:manager');
});

require __DIR__.'/auth.php';
