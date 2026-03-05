<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\InvoiceCreated;
use App\Jobs\GenerateInvoicePdf;

class GenerateInvoicePdfListener
{
    public bool $afterCommit = true;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(InvoiceCreated $event): void
    {
        GenerateInvoicePdf::dispatch($event->invoice);
    }
}
