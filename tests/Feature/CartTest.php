<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    private $user;

    private $token;
    
    private $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('test')->plainTextToken;
        $this->product = Product::factory()->create();

    }

    public function test_add_to_cart(): void
    {
        $response = $this->withHeader('Authorization', 'Bearer ' .$this->token)->json('POST', route('cart'), [
            'product' => $this->product->name,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_checkout():void
    {
        $response = $this->withHeader('Authorization', 'Bearer ' .$this->token)->json('POST', route('checkout'));

        $response->assertStatus(Response::HTTP_OK);
    }
}
