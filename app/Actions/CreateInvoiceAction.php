<?php

declare(strict_types=1);

namespace App\Actions;

use App\Jobs\GenerateInvoicePdf;
use App\Models\Invoice;
use App\Services\CreditService;
use Exception;
use Illuminate\Support\Facades\Auth;

class CreateInvoiceAction
{
    public function __construct(protected CreditService $creditService) {}

    /**
     * @throws Exception
     */
    public function execute(array $data): Invoice
    {
        $tenant = Auth::user()->tenant;

        $fee = 1.00;

        if ($this->creditService->deductCredits($tenant, $fee)) {

            $invoice = $tenant->invoices()->create([
                'invoice_number' => $data['invoice_number'],
                'total_amount' => $data['total_amount'],
            ]);

            GenerateInvoicePdf::dispatch($invoice);

            return $invoice;

        }
        throw new Exception('Insufficient credits');
    }
}
