<?php

use App\Http\Controllers\Auth\RegisteredTenantController;
use App\Http\Controllers\Auth\SessionController;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredTenantController::class, 'create']);
    Route::post('register', [RegisteredTenantController::class, 'store'])->name('register');
    Route::get('login', [SessionController::class, 'create'])->name('login');
    Route::post('login', [SessionController::class, 'store']);
});

Route::middleware(['auth', 'tenant'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
});

Route::get('logout', function () {
    auth()->logout();

    return redirect()->route('login');
});
