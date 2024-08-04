<?php

namespace Tests\Feature;

use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\AssertableJsonString;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Throwable;

class LotteryTest extends TestCase
{

    /**
     * @throws Throwable
     */
    private function register_and_login_user(): AssertableJsonString
    {
        $random = md5(rand());
        $user = [
            'email' => "$random@gmail.com",
            'name' => "asdasd",
            'password' => "12345",
        ];

        $this->post('/api/register', [
            "email" => $user['email'],
            "name" => $user['name'],
            "password" => $user['password'],
            "c_password" => $user['password']
        ]);

        $response = $this->post('/api/login', [
            "email" => $user['email'],
            "password" => $user['password']
        ]);

        return $response->decodeResponseJson();
    }

    /**
     * @throws Throwable
     */
    public function test_get_lotteries(): void
    {
        $login = $this->register_and_login_user();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$login['data']['token']}"
        ])
            ->get('/api/lotteries');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'matches_2',
                    'matches_3',
                    'matches_4',
                    'matches_5',
                    'number_of_tickets',
                ],
                'success',
                'message'
            ]);
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function test_post_lotteries(): void
    {
        $login = $this->register_and_login_user();

        $lottery = [
            'matches_2' => random_int(10, 200),
            'matches_3' => random_int(10, 200),
            'matches_4' => random_int(10, 200),
            'matches_5' => random_int(0, 1),
            'number_of_tickets' => random_int(601, 1000),
        ];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$login['data']['token']}"
        ])
            ->post('/api/lotteries', $lottery);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'matches_2',
                    'matches_3',
                    'matches_4',
                    'matches_5',
                    'number_of_tickets',
                ],
                'success',
                'message'
            ]);
    }
}
