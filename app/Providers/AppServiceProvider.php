<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\PaymentServiceProvider;
use App\Services\Payments\RazorpayPaymentServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentServiceProvider::class, RazorpayPaymentServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
