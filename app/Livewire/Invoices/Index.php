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

    public $searchQuery = '';
    public $status = '';
    public $period = '';

    public function render()
    {
        $query = Invoice::query();

        if ($this->searchQuery) {
            $query->where('invoice_number', 'like', '%' . $this->searchQuery . '%')
                ->orWhere('customer_name', 'like', '%' . $this->searchQuery . '%');
        }

        if ($this->status && $this->status !== '*') {
            $query->where('status', $this->status);
        }

        if ($this->period) {
            match ($this->period) {
                'today' => $query->whereDate('invoice_date', today()),
                'this_week' => $query->whereBetween('invoice_date', [now()->startOfWeek(), now()->endOfWeek()]),
                'this_month' => $query->whereMonth('invoice_date', now()->month)->whereYear('invoice_date', now()->year),
                'this_year' => $query->whereYear('invoice_date', now()->year),
                default => $query,
            };
        }

        return view('livewire.invoices.index', [
            'invoices' => $query->latest()->paginate(10),
        ]);
    }

    public function clearFilters(){
        $this->reset(['searchQuery', 'status', 'period']);
    }
}
