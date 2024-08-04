<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_registration_and_login(): void
    {
        $random = md5(rand());
        $user = [
            'email' => "$random@gmail.com",
            'name' => "asdasd",
            'password' => "12345",
        ];

        $response = $this->post('/api/register', [
            "email" => $user['email'],
            "name" => $user['name'],
            "password" => $user['password'],
            "c_password" => $user['password']
        ]);


        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'token'
                ],
                'success',
                'message'
            ]);

        $response = $this->post('/api/login', [
            "email" => $user['email'],
            "password" => $user['password']
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'token'
                ],
                'success',
                'message'
            ]);
    }
}
