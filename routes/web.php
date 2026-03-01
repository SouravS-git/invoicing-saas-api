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
    Route::get('/register', [RegisteredTenantController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredTenantController::class, 'store']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::middleware(['auth', 'tenant'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/invoices', Index::class)->name('invoices.index');
    Route::get('/invoices/create', Create::class)->name('invoices.create');

    Route::get('/billing', TopUp::class)->name('billing');

    Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::get('/test', function () {
    return view('pdfs.invoice', [
        'invoice' => \App\Models\Invoice::first(),
    ]);
});
