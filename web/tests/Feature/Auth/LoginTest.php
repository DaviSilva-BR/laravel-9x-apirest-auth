<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testSuccessLogin()
    {
        $payload = [
            "email" => "admin@gmail.com",
            "password" => "123"
        ];

        $response = $this->json('POST', 'api/login', $payload, ['Accept' => 'application/json']);
        $response->assertStatus(200);
    }

    public function testErrorLoginPassword()
    {
        $payload = [
            "email" => "admin@gmail.com",
            "password" => "000"
        ];

        $response = $this->json('POST', 'api/login', $payload, ['Accept' => 'application/json']);
        $response->assertJson([
            'message' => 'Unauthorized'
        ]);
    }
}
