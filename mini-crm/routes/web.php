<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard от Breeze (можно оставить)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Leads
    Route::resource('leads', LeadController::class);

    // Tasks (внутри лидов)
    Route::post('/leads/{lead}/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');

    Route::put('/tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update');

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
        
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
