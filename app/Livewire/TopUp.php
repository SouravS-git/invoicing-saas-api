<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Services\CreditService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TopUp extends Component
{
    public $amount;

    public function render()
    {
        return view('livewire.top-up');
    }

    public function addBalance(CreditService $creditService): void
    {
        $this->validate([
            'amount' => ['required', 'numeric', 'min:1', 'max:1000'],
        ]);

        $tenant = Auth::user()->tenant;
        $creditService->addCredits($tenant, (float) $this->amount);

        session()->flash('success', '{$this->amount} credits added to your account.');

        $this->dispatch('balance-updated');
    }
}
