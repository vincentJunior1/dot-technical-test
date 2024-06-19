<?php

namespace Tests\Feature;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CitiesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGetDataCities(): void
    {
        $credentials = [
            'email' => 'admin@example.com',
            'password' => 'password',
        ];
        $token = JWTAuth::attempt($credentials);
        $token = compact('token');
        $response = $this->withHeader('Authorization', 'Bearer '.$token['token'])->get('/api/search/cities/{1}');

        $response->assertStatus(200);
        // $response->assertCount(1)
    }
}
