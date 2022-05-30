<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Product listing test
     *
     * @return void
     */
    public function test_product_listing()
    {
        $response = $this->getJson('/api/product');

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'products'
            ]
        );
        $response->assertExactJson(
            [
                'products' => [
                    ['id' => 1, 'name' => 'Humira subscription', 'price' => 4900],
                    ['id' => 2, 'name' => 'Januvia subscription', 'price' => 4900]
                ]
            ]
        );
    }
}
