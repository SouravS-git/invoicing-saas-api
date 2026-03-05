<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::creating(function (Payment $payment) {
            $payment->tenant_id = auth()->user()->tenant_id;
            $payment->payment_by = auth()->id();
        });
    }
}
