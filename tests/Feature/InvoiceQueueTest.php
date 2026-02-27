<?php

use App\Actions\CreateInvoiceAction;
use App\Jobs\GenerateInvoicePdf;
use App\Models\Tenant;
use App\Models\User;

test('creating an invoice dispatches a PDF generation job', function () {
    Queue::fake(); // Don't actually run the job

    $tenant = Tenant::factory()->create([
        'credit_balance' => 10.00
    ]);

    $user = User::factory()->for($tenant, 'tenant')->create();

    $this->actingAs($user);

    $action = app(CreateInvoiceAction::class);
    $action->execute([
        'invoice_number' => '12345',
        'total_amount' => 100
    ]);

    // Assert the job was pushed to Redis
    Queue::assertPushed(GenerateInvoicePdf::class);
});
