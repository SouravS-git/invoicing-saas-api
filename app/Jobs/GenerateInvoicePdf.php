<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class GenerateInvoicePdf implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Invoice $invoice)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Generating PDF for invoice: '.$this->invoice->invoice_number);

        // TODO: Generate PDF (Now simulating)
        sleep(3);

        $this->invoice->update([
            // 'status' => 'sent',
            'pdf_path' => 'invoices/{$this->invoice->id}.pdf',
        ]);
    }
}
