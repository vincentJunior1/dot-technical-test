<?php

namespace Tests\Feature;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class ProvinceTest extends TestCase
{

    /**
     * A basic feature test example.
     */
    public function testGetDataProvince(): void
    {
        $credentials = [
            'email' => 'admin@example.com',
            'password' => 'password',
        ];
        $token = JWTAuth::attempt($credentials);
        $token = compact('token');
        $response = $this->withHeader('Authorization', 'Bearer '.$token['token'])->get('/api/search/province/{1}');

        $response->assertStatus(200);
        // $response->assertCount(1)
    }
}
