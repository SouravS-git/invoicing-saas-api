<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tenant = Tenant::factory()->create([
            'name' => 'Demo Company',
            'credit_balance' => 10,
        ]);

        $users = User::factory()->for($tenant, 'tenant')->create([
            'name' => 'Sourav Sarkar',
            'email' => 'isourav2018@gmail.com',
            'password' => '12345678',
        ]);

        $invoices = Invoice::factory(10)->for($tenant, 'tenant')->create();

        User::factory(10)->create();
    }
}
