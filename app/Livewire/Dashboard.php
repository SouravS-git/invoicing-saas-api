<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Invoice;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_invoices' => Invoice::count(),
            'paid_invoices' => Invoice::where('status', 'paid')->count(),
            'due_invoices' => Invoice::where('status', 'due')->count(),
        ];

        $chartData = Invoice::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();


        return view('livewire.dashboard', [
            'stats' => $stats,
            'chartLabels' => $chartData->pluck('date'),
            'chartValues' => $chartData->pluck('count'),
        ]);
    }
}
