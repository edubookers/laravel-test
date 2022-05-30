<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    protected array $payload = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com',
        'password' => '123123123',
        'password_re' => '123123123'
    ];

    /**
     * Customer registration test
     *
     * @return void
     */
    public function test_register_customer_returns_a_successful_response()
    {
        $response = $this->postJson('/api/customer', $this->payload);

        $response->assertStatus(204);
    }

    /**
     * Customer registration validator test
     *
     * @return void
     */
    public function test_register_customer_validation()
    {
        $this->postJson('/api/customer', $this->payload);
        $response = $this->postJson('/api/customer', $this->payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email' => 'The email has already been taken.']);
    }
}
