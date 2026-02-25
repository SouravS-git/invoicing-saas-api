<?php

use App\Models\Tenant;
use App\Models\User;

it('a user can access data which belongs only to their tenant', function () {
    $firstTenant = Tenant::factory()->create();
    User::factory(10)->create([
        'tenant_id' => $firstTenant->id,
    ]);

    $secondTenant = Tenant::factory()->create();

    $this->withSession([
        'tenant_id' => $firstTenant->id,
    ]);
    expect(User::all())->toHaveCount(10);

    $this->withSession([
        'tenant_id' => $secondTenant->id,
    ]);
    expect(User::all())->toHaveCount(0);

});
