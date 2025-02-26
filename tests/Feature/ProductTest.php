<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    private $user;

    private $token;
    
    private $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('test')->plainTextToken;
        $this->product = Product::factory()->count(3)->create();
    }

    public function test_products_list(): void
    {
        $response = $this->withHeader('Authorization', 'Bearer '. $this->token)->json('GET', route('products'));

        $response->assertStatus(Response::HTTP_OK);
    }
}
