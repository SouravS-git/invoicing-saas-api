<?php

declare(strict_types=1);

namespace App\Livewire\Credits;

use App\Actions\ProcessSuccessfulPayment;
use App\Contracts\PaymentServiceProvider;
use App\Models\Payment;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Credits')]
class TopUp extends Component
{
    use withPagination;

    public float $amount;

    public function render()
    {
        return view('livewire.credits.top-up', [
            'transactions' => Payment::where('tenant_id', auth()->user()->tenant_id)->latest()->paginate(10),
            'balance' => auth()->user()->tenant->credit_balance,
        ]);
    }

    public function initiatePayment(PaymentServiceProvider $paymentServiceProvider): void
    {
        $this->validate([
            'amount' => ['required', 'numeric', 'min:10', 'max:1000'],
        ], [
            'amount.min' => 'Please enter a minimum of 10',
            'amount.max' => 'Maximum amount is 1000',
        ]);

        $tenant = auth()->user()->tenant;

        $orderData = $paymentServiceProvider->createOrder($tenant, $this->amount);

        $this->dispatch('open-checkout', $orderData);
    }

    #[On('verify-payment')]
    public function verifyPayment(PaymentServiceProvider $paymentServiceProvider, $response): void
    {
        if ($paymentServiceProvider->verifyPayment($response)) {
            $this->dispatch('payment-successful', response: $response);
        } else {
            $this->dispatch('payment-failed');
        }
    }

    #[On('payment-successful')]
    public function handlePaymentSuccess(ProcessSuccessfulPayment $processSuccessfulPayment, array $response): void
    {
        $tenant = auth()->user()->tenant;
        $amount = Payment::where('payment_id', $response['razorpay_payment_id'])->first()->amount;

        $processSuccessfulPayment->execute($tenant, (float) $amount);

        session()->flash('success', 'Payment successful !');
    }

    #[On('payment-failed')]
    public function handlePaymentFailure(): void
    {
        session()->flash('error', 'Payment failed !');
    }
}
