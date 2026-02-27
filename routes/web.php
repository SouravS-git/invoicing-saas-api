<?php

use App\Http\Controllers\Auth\RegisteredTenantController;
use App\Http\Controllers\Auth\SessionController;
use App\Livewire\Credits\TopUp;
use App\Livewire\Dashboard;
use App\Livewire\Invoices\Create;
use App\Livewire\Invoices\Index;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', fn () => view('home'))->name('home');
    Route::get('/register', [RegisteredTenantController::class, 'create'])->name('register.create');
    Route::post('/register', [RegisteredTenantController::class, 'store'])->name('register.store');
    Route::get('/login', [SessionController::class, 'create'])->name('login.create');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');
});

Route::middleware(['auth', 'tenant'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/invoices', Index::class)->name('invoices.index');
    Route::get('/invoices/create', Create::class)->name('invoices.create');

    Route::get('/billing', TopUp::class)->name('billing');

    Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
});
