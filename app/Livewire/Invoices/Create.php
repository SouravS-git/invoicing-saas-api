<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use Exception;
use App\Actions\CreateInvoiceAction;
use Livewire\Component;

class Create extends Component
{
    public $invoice_number;

    public $total_amount;

    public function render()
    {
        return view('livewire.invoices.create');
    }

    public function rules(): array
    {
        return [
            'invoice_number' => ['required', 'numeric'],
            'total_amount' => ['required', 'numeric', 'min:1'],
        ];
    }

    public function save(CreateInvoiceAction $action): void
    {
        $this->validate();

        try {
            $action->execute([
                'invoice_number' => $this->invoice_number,
                'total_amount' => $this->total_amount,
            ]);

            $this->redirect(route('invoices.index'), navigate: true);

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }
}
