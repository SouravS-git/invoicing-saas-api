<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InsufficientBalanceException;
use App\Models\Tenant;

class CreditService
{
    public function addCredits(Tenant $tenant, float $amount): void
    {
        $tenant->increment('credit_balance', $amount);
    }

    /**
     * @throws InsufficientBalanceException
     */
    public function deductCredits(Tenant $tenant, float $amount): void
    {
        if ($tenant->credit_balance < $amount) {
            throw new InsufficientBalanceException;
        }

        $tenant->decrement('credit_balance', $amount);
    }
}
