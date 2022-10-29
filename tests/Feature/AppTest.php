<?php

namespace Tests\Feature;

use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class AppTest extends TestCase
{

    public function test_1(): void
    {
        $response = $this->post(
            '/crawl/iso-4217',
            [
                'code' => 'GBP'
            ]
        );

        $response->assertStatus(200);
    }

    public function test_2(): void
    {
        $response = $this->post(
            '/crawl/iso-4217',
            [
                'code_list' => ['GBP', 'GEL', 'HKD']
            ]
        );

        var_dump($response->json());

        $response->assertStatus(200);
    }

    public function test_3(): void
    {
        $response = $this->post(
            '/crawl/iso-4217',
            [
                'number' => 242
            ]
        );

        $response->assertStatus(200);
    }

    public function test_4(): void
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
