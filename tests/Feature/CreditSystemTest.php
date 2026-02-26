<?php

use App\Actions\CreateInvoiceAction;
use App\Models\Tenant;
use App\Models\User;
use App\Services\CreditService;

it('tenants can top-up and spend credits on creating invoices', function () {
    $tenant = Tenant::factory()->create();
    $user = User::factory()->for($tenant, 'tenant')->create();

    app(CreditService::class)->addCredits($tenant, 100);
    expect($tenant->fresh()->credit_balance)->toBe(100.00);

    $this->actingAs($user);
    app(CreateInvoiceAction::class)->execute([
        'invoice_number' => 'INV-123',
        'total_amount' => 500.00,
    ]);

    expect($tenant->fresh()->credit_balance)->toBe(99.00);
    $this->assertDatabaseHas('invoices', [
        'invoice_number' => 'INV-123',
        'total_amount' => 500.00,
    ]);

});
