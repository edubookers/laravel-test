<?php

namespace Tests\Feature;

use App\Traits\WithAuth;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use WithAuth;

    /**
     * Customer registration test
     *
     * @return void
     */
    public function test_purchase_product_returns_a_successful_response()
    {
        $this->auth();
        $response = $this->withHeader('Authorization', 'Bearer '.$this->token)
            ->postJson('/api/purchase/product/1');
        $response->assertStatus(102);
    }

    /**
     * Product listing test
     *
     * @return void
     */
    public function test_product_listing()
    {
        $this->auth();
        $response = $this->withHeader('Authorization', 'Bearer '.$this->token)
            ->getJson('/api/product');

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                '*' => [
                    'description',
                    'price',
                    'created_at',
                    'updated_at'
                ]
            ]
        );
    }

}
