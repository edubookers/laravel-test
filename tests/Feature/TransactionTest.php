<?php

namespace Tests\Feature;

use App\Traits\WithAuth;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use WithAuth;

    /**
     * Transaction listing test
     *
     * @return void
     */
    public function test_transaction_listing()
    {
        $this->auth();

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->getJson('/api/purchase/transactions');

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                '*' => [
                    'user_id',
                    'specs',
                    'product_type',
                    'product_id',
                    'created_at',
                    'updated_at'
                ]
            ]
        );
    }
}
