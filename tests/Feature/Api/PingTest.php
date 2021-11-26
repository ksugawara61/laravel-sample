<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class PingTest extends TestCase
{
    /**
     * @test
     */
    public function getPing()
    {
        $response = $this->get('/api/ping');

        $response->assertStatus(200);
        $response->assertExactJson((['message' => 'pong']));
    }
}
