<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testSuccessRegistration()
    {
        $payload = [
            "name" => "User",
            "email" => "user@gmail.com",
            "password" => "123",
            "password_confirmation" => "123"
        ];

        $this->json('POST', 'api/register', $payload, ['Accept' => 'application/json'])
        ->assertStatus(200);
    }

    public function testErrorRegistrationPasswordsDontMatch()
    {
        $payload = [
            "name" => "User",
            "email" => "user@gmail.com",
            "password" => "123",
            "password_confirmation" => "000"
        ];

        $response = $this->json('POST', 'api/register', $payload, ['Accept' => 'application/json']);
        $response->assertJson([
            'message' => 'error'
        ]);
    }
}
