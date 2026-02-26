<?php

it('allows tenants to register themselves', function () {
    $response = $this->post(route('register'), [
        'company_name' => 'Test Company',
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirectToRoute('dashboard');

    $this->assertDatabaseHas('users', [
        'name' => 'Admin User',
        'email' => 'admin@example.com',
    ]);

    $this->assertDatabaseHas('tenants', [
        'name' => 'Test Company',
        'credit_balance' => 0,
    ]);

    $user = auth()->user();
    expect($user->tenant->name)->toBe('Test Company');

});
