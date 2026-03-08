<?php

namespace App\Enums;

enum InvoiceStatus: string
{
    case DUE = 'due';
    case PAID = 'paid';

    public function label(): string
    {
        return match ($this) {
            self::DUE => 'Due',
            self::PAID => 'Paid',
        };
    }
}
