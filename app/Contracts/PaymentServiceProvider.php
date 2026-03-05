<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Models\Tenant;

interface PaymentServiceProvider
{
    public function createOrder(Tenant $tenant, float $amount): array;

    public function verifyPayment(array $payload): bool;
}
