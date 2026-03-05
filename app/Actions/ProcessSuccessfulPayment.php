<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Tenant;
use App\Services\CreditService;

class ProcessSuccessfulPayment
{
    public function __construct(protected CreditService $creditService) {}

    public function execute(Tenant $tenant, float $amount): void
    {
        $this->creditService->addCredits($tenant, $amount);
    }
}
