<?php

declare(strict_types=1);

namespace App\Actions\Invoice;

use App\Events\InvoiceCreated;
use App\Models\Invoice;
use App\Models\Tenant;
use App\Services\CreditService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateInvoiceAction
{
    public function __construct(protected CreditService $creditService) {}

    public function execute(array $data): Invoice
    {
        $user = auth()->user();

        return DB::transaction(function () use ($user, $data) {
            $fee = 1.00;

            $tenant = Tenant::where('id', $user->tenant_id)
                ->lockForUpdate()
                ->first();

            $this->creditService->deductCredits($tenant, $fee);

            $latestInvoice = Invoice::where('tenant_id', $tenant->id)
                ->latest('id')
                ->first();

            $nextNumber = $latestInvoice ? ((int) substr((string) $latestInvoice->invoice_number, -6)) + 1 : 1;
            $invoiceNumber = sprintf(Str::upper(substr(Str::slug($tenant->name), 0, 3)).'-%06d', $nextNumber);

            $invoice = Invoice::create([
                'invoice_number' => $invoiceNumber,
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],
                'billing_address' => $data['billing_address'],
                'invoice_date' => $data['invoice_date'],
                'payment_method' => $data['payment_method'],
                'status' => $data['status'],
                'total_amount' => $data['total_amount'],
            ]);

            InvoiceCreated::dispatch($invoice);

            return $invoice;

        });
    }
}
