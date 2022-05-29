<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /**
     * Transaction listing test
     *
     * @return void
     */
    public function test_transaction_listing()
    {
        $response = $this->getJson('/api/transaction');

        $response->assertStatus(200);
        $response->assertExactJson(
            [
                'transactions' => [
                    ['id' => 1, 'amount' => 4900, 'status'=> 'failed', 'created_at' => '2022-05-15 15:00:00'],
                    ['id' => 2, 'amount' => 4900, 'status'=> 'succeeded', 'created_at' => '2022-05-16 15:00:00'],
                ]
            ]
        );
    }
}
