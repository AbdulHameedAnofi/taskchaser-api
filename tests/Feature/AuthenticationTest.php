<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    private $user;

    private $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('test')->plainTextToken;
    }

    public function test_user_registration_works(): void
    {
        $response = $this->json('POST', route('register'), [
            'name' => fake()->name,
            'email' => fake()->email,
            'phone' => '08012345678',
            'address' => 'No 1, John Doe Street',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_user_signin_validates()
    {
        $response = $this->json('POST', route('signin'), [
            'email' => $this->user->email,
            'password' => 'passworduser',
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }
    
    public function test_admin_signin_works()
    {
        $response = $this->json('POST', route('signin'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
