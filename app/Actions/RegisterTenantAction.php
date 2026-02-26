<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegisterTenantAction
{
    public function execute(array $data): User
    {
        return DB::transaction(function () use ($data) {

            $tenant = Tenant::create([
                'name' => $data['company_name'],
            ]);

            return $tenant->users()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => ($data['password']),
            ]);

        });

    }
}
