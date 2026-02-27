<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.invoices.index', [
            'invoices' => Invoice::latest()->paginate(10),
        ]);
    }
}
