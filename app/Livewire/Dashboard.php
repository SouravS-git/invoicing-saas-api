<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public $tenant;

    public $admin;

    public $totalUsers;

    public $totalInvoices;

    public $availableCredits;

    public function mount(): void
    {
        $this->admin = Auth::user()->email;
        $this->tenant = Auth::user()->tenant;
        $this->totalUsers = User::all()->count();
        $this->totalInvoices = Invoice::all()->count();
        $this->availableCredits = $this->tenant->credit_balance;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
