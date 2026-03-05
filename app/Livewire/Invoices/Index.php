<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Invoices')]
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.invoices.index', [
            'invoices' => Invoice::latest()->paginate(8),
        ]);
    }
}
