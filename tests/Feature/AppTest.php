<?php

namespace Tests\Feature;

use App\UseCases\CrawlIso4217\ByCodeInteractor;
use App\UseCases\CrawlIso4217\Contracts\ByCodeIntContract;
use App\UseCases\CrawlIso4217\Contracts\InputContract;
use App\UseCases\CrawlIso4217\Interactor;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

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

    public function test_3(): void
    {
        $interactor = new ByCodeInteractor('GBP');

        $contract = new ByCodeIntContract;

        $contract->code = 'GBP';

        $contract->number = 826;

        $contract->decimal = 2;

        $contract->currency = 'Libra Esterlina';
        
        $contract->currencyLocations[0] = 'Reino Unido, Ilha de Man, Guernesey, Jersey';

        assertTrue(
            $interactor->interactorContract === $contract
        );
    }
}
