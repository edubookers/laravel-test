<?php

namespace Tests\Feature;

use App\Traits\WithAuth;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use WithAuth;

    /**
     * Customer registration test
     *
     * @return void
     */
    public function test_purchase_subscription_returns_a_successful_response()
    {
        $this->auth();

        $response = $this->withHeader('Authorization',
            'Bearer '.$this->token)->postJson('/api/purchase/subscription/1');

        $response->assertStatus(102);
    }

    /**
     * Subscription listing test
     *
     * @return void
     */
    public function test_subscription_listing()
    {
        $this->auth();

        $response = $this->withHeader('Authorization', 'Bearer '.$this->token)
            ->getJson('/api/purchase/subscription');

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                '*' => [
                    'title',
                    'price',
                    'created_at',
                    'updated_at',
                    'expired_at'
                ]
            ]
        );
    }

}
