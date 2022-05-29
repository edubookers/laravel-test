<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    /**
     * Customer registration test
     *
     * @return void
     */
    public function test_register_customer_returns_a_successful_response()
    {
        $response = $this->postJson('/api/customer', [
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'john.doe@example.com'
        ]);

        $response->assertStatus(204);
    }

    /**
     * Customer registration validator test
     *
     * @return void
     */
    public function test_register_customer_validation()
    {
        $response = $this->postJson('/api/customer', [
            'first_name' => 'Jonny',
            'last_name'  => 'Walker',
            'email'      => 'jonny.walker@example.com'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email' => 'The email is already in use.']);
    }
}
