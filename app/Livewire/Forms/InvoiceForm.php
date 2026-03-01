<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use Livewire\Form;

class InvoiceForm extends Form
{
    public $customer_name;

    public $customer_email;

    public $customer_phone;

    public $billing_address;

    public $invoice_date;

    public $payment_method;

    public $status;

    public $total_amount;

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'min:10', 'max:10'],
            'billing_address' => ['nullable', 'string', 'max:255'],
            'invoice_date' => ['required', 'date'],
            'payment_method' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:255'],
            'total_amount' => ['required', 'numeric', 'min:1'],
        ];
    }
}
