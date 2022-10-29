<?php

namespace Tests\Feature;

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
            '/crawl/iso-4217',
            [
                'code' => 'GBP'
            ]
        );

        var_dump($response->json());

        $response->assertStatus(200);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_2()
    {
        $response = $this->post(
            '/crawl/iso-4217',
            [
                "code_list" => ["GBP", "GEL", "HKD"]
            ]
        );

        var_dump($response->json());

        $response->assertStatus(200);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_3()
    {
        $response = $this->post(
            '/crawl/iso-4217',
            [
                'number' => 242
            ]
        );

        var_dump($response->json());

        $response->assertStatus(200);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_4()
    {
        $response = $this->post(
            '/crawl/iso-4217',
            [
                'number_list' => [242, 324]
            ]
        );

        var_dump($response->json());

        $response->assertStatus(200);
    }
}
