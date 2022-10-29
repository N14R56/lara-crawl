<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_1()
    {
        $response = $this->post(
            '/crawl',
            [
                'code' => 'GBP'
            ]
        );

        echo $response->json();

        $response->assertStatus(200);
    }
}
