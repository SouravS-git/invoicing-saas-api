<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'created_by' => User::factory(),
            'invoice_number' => $this->faker->unique()->numerify('INV-####'),
            'invoice_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->email(),
            'customer_phone' => $this->faker->phoneNumber(),
            'billing_address' => $this->faker->address(),
            'total_amount' => $this->faker->randomFloat(2, 1000, 100000),
            'payment_method' => 'cash',
            'status' => 'due',
            'pdf_path' => $this->faker->url(),
        ];
    }
}
