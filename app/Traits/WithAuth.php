<?php

namespace App\Traits;

trait WithAuth
{
    private string|null $token = null;
    protected array $testUserPayload = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'test.user@example.com',
        'password' => '123123123',
        'password_re' => '123123123'
    ];

    public function auth()
    {
        $response = $this->postJson('/api/customer', $this->testUserPayload);

        $response->assertStatus(204);

        $response = $this->postJson('/api/login', [
            'email' => $this->testUserPayload['email'],
            'password' => $this->testUserPayload['password']
        ]);

        $response->assertStatus(200);

        $this->token = json_decode($response->getContent(),true)['token'];
    }
}
