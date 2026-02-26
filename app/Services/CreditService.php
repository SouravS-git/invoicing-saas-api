<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class CreditService
{
    public function addCredits(Tenant $tenant, float $amount): void
    {
        $tenant->increment('credit_balance', $amount);
    }

    public function deductCredits(Tenant $tenant, float $amount): bool
    {
        return DB::transaction(function () use ($tenant, $amount): bool {

            $currentBalance = DB::table('tenants')
                ->lockForUpdate()
                ->find($tenant->id)->credit_balance;

            if ($currentBalance < $amount) {
                return false;
            }

            $tenant->decrement('credit_balance', $amount);

            return true;

        });
    }
}
