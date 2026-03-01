<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Actions\Invoice\CreateInvoiceAction;
use App\Exceptions\InsufficientBalanceException;
use App\Livewire\Forms\InvoiceForm;
use Exception;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create Invoice')]
class Create extends Component
{
    public InvoiceForm $form;

    public function mount(): void
    {
        $this->form->invoice_date = now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.invoices.create');
    }

    public function store(CreateInvoiceAction $action): void
    {
        $validatedData = $this->form->validate();

        try {
            $action->execute($validatedData);
            $this->redirect(route('invoices.index'), navigate: true);

            session()->flash('success', 'Invoice created successfully.');

        } catch (InsufficientBalanceException) {
            $this->addError('error', 'You do not have enough credits.');
        } catch (Exception) {
            $this->addError('error', 'Something went wrong. Please try again.');
        }
    }
}
