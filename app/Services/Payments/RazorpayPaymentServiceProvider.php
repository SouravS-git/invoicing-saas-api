<?php

declare(strict_types=1);

namespace App\Services\Payments;

use App\Contracts\PaymentServiceProvider;
use App\Models\Payment;
use App\Models\Tenant;
use Exception;
use Razorpay\Api\Api;

class RazorpayPaymentServiceProvider implements PaymentServiceProvider
{
    protected Api $api;

    public function __construct()
    {
        $this->api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
    }

    public function createOrder(Tenant $tenant, float $amount): array
    {
        $order = $this->api->order->create([
            'amount' => $amount * 100,
            'currency' => 'INR',
        ]);

        return [
            'key' => config('services.razorpay.key'),
            'amount' => $order['amount'],
            'currency' => $order['currency'],
            'name' => config('app.name'),
            'description' => 'Credit Purchase',
            'image' => 'https://razorpay.com/docs/assets/img/razorpay-logo.svg',
            'order_id' => $order['id'],
            'prefill' => [
                'name' => $tenant->name,
                'email' => auth()->user()->email,
                'contact' => 7019056639,
            ],
            'notes' => [
                'address' => $tenant->name.'Office',
            ],
            'theme' => [
                'color' => '#F37254',
            ],
            // 'callback_url' => '',    // Using handler instead for JavaScript-Based Response
        ];

    }

    public function verifyPayment(array $payload): bool
    {
        try {
            $this->api->utility->verifyPaymentSignature($payload);
            $payment = $this->api->payment->fetch($payload['razorpay_payment_id'])->toArray();

            if ($payment['captured']) {

                if (Payment::where('payment_id', $payment['id'])->exists()) {
                    return false;
                }

                Payment::create([
                    'payment_id' => $payment['id'],
                    'order_id' => $payment['order_id'],
                    'amount' => $payment['amount'] / 100,
                    'currency' => $payment['currency'],
                    'status' => $payment['status'],
                    'payment_method' => $payment['method'],
                    'description' => $payment['description'],
                ]);

                return true;
            }

            return false;

        } catch (Exception) {
            return false;
        }
    }
}
