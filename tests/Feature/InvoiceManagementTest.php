<?php

use App\Livewire\Invoices\Create;
use App\Models\Tenant;
use App\Models\User;

it('allows users to see their balance decreases when an invoice is created', function () {
    $tenant = Tenant::factory()->create([
        'credit_balance' => 100.00,
    ]);
    $user = User::factory()->for($tenant, 'tenant')->create();

    $this->actingAs($user);

    Livewire::test(Create::class)
        ->set('invoice_number', '123')
        ->set('total_amount', 500.00)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('invoices.index'));

    $this->assertDatabaseHas('invoices', [
        'tenant_id' => $tenant->id,
        'invoice_number' => '123',
        'total_amount' => 500.00,
    ]);

    expect($tenant->fresh()->credit_balance)->toBe(99.00);
});
