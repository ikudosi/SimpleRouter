<?php

namespace Tests\Unit;

use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_text_content_is_rendered()
    {
        $response = $this->call("GET", "/api/v1/test/show/text", [], false);

        $this->assertEquals($response, "Everything is awesome!");
    }

    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_router_calls_anonymous_function()
    {
        // This test really ensures that:
        // 1) router calls an anonymous function
        // 2) multiple dynamic arguments are being passed to the function

        $user_id = rand(1,100);
        $address_id = rand(1,100);

        $response = $this->call("GET", "/api/v1/user/{$user_id}/address/{$address_id}");

        $this->assertEquals($response['data'][0]['id'], $user_id);
        $this->assertEquals($response['data'][0]['address_id'], $address_id);
    }

    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_post_data_is_displayed()
    {
        $test_json_data = 'Tony Starks built this in a cave... with a pile of scraps!';

        $response = $this->call('POST', '/api/v1/test/post', [
            'text' => $test_json_data
        ]);

        $this->assertTrue(array_key_exists('text', $response));
        $this->assertTrue($response['text'] === $test_json_data);
    }
}