<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;

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

        $html = view('pdfs.invoice', ['invoice' => $this->invoice])->render();

        $pdfContent = Browsershot::html($html)
            ->paperSize(58, 1000, 'mm')
            ->margins(0, 0, 0, 0)
            ->showBackground()
            ->deviceScaleFactor(2)
            ->pdf();

        $path = "invoices/" . $this->invoice->tenant_id . "/" . now()->format('Y-m-d') . "/" . $this->invoice->invoice_number . ".pdf";

        if(Storage::disk('s3')->put($path, $pdfContent)){
            $this->invoice->update([
                'pdf_path' => $path,
            ]);
        }
    }
}
