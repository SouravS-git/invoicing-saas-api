<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Database\Factories\InvoiceFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[ScopedBy(TenantScope::class)]
class Invoice extends Model
{
    /** @use HasFactory<InvoiceFactory> */
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'billing_address',
        'invoice_date',
        'payment_method',
        'status',
        'total_amount',
        'pdf_path',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function booted(): void
    {
        static::creating(function (Invoice $invoice) {
            $invoice->tenant_id = auth()->user()->tenant_id;
            $invoice->created_by = auth()->id();
        });
    }

    public function generateTemporaryUrl(): string
    {
        return Storage::disk('s3')->temporaryUrl(
            $this->pdf_path, now()->addMinutes(30)
        );
    }
}
