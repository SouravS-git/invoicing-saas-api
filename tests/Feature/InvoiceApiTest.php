<?php

use App\Models\Invoice;
use App\Models\Tenant;
use App\Models\User;

it('authenticated tenants can see only their own invoices', function () {
    $tenant = Tenant::factory()->create();
    $user = User::factory()->for($tenant, 'tenant')->create();

    $invoice = Invoice::factory()->for($tenant, 'tenant')->create([
        'invoice_number' => 'INV-123',
        'total_amount' => 100.00,
    ]);

    $invoice2 = Invoice::factory()->create();

    $this->actingAs($user);
    $response = $this->getJson('/api/invoices');

    $response
        ->assertStatus(200)
        ->assertJsoncount(1);

    $response->assertJsonFragment([
        'invoice_number' => 'INV-123',
        'total_amount' => '100.00',
    ]);

});
