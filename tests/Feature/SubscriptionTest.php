<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    /**
     * Subscription listing test
     *
     * @return void
     */
    public function test_subscription_listing()
    {
        $response = $this->getJson('/api/subscription');

        $response->assertStatus(200);
        $response->assertExactJson(
            [
                'subscriptions' => [
                    ['id' => 1, 'product' => ['id' => 1, 'name' => 'Humira subscription', 'price' => 4900], 'created_at' => '2022-03-31 15:00:00', 'next_due_date' => '2022-04-30 15:00:00'],
                ]
            ]
        );
    }

    /**
     * Customer registration test
     *
     * @return void
     */
    public function test_create_subscription_returns_a_successful_response()
    {
        $response = $this->postJson('/api/subscription', [
            'product_id' => '1'
        ]);

        $response->assertStatus(204);
    }
}
