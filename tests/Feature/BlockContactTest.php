<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class BlockContactTest extends TestCase
{


    public function testCorporateLogin()
    {
        $response = $this
            ->post('login', ['email' => 'amir@amir.com', 'password' => '11111111']);

dd($response->decodeResponseJson());

        $response->assertStatus(200);

        $access_token = 'Bearer ' . $response->decodeResponseJson()['access_token'];

        return $access_token;
    }

    /**
     * @depends testCorporateLogin
     */
    public function test_show_blocked_contacts($access_token)
    {
        $response = $this
            ->patch( '/api/corporate/v1/depot', [], [
                'Authorization' => $access_token,
                'Content-Type' => 'application/json'
            ]);

        dump($response->decodeResponseJson());

        $response->assertStatus(200);
    }
}
