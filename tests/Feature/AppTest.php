<?php

namespace Tests\Feature;

use Tests\TestCase;

class AppTest extends TestCase
{
    public function test_1(): void
    {
        // {
        //     "code_list" : [
        //         "GBP",
        //         "GEL",
        //         "HKD"
        //     ]
        // }

        $response = $this->post(
            '/crawl/iso-4217',
            [
                'code_list' => ['GBP', 'GEL', 'HKD']
            ]
        );

        var_dump($response->json());

        $response->assertStatus(200);
    }

    public function test_2(): void
    {
        $response = $this->post(
            '/crawl/iso-4217',
            [
                'number_list' => [242, 324]
            ]
        );

        $response->assertStatus(200);
    }
}
