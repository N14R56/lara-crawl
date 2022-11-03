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

        $contractMock = new ByCodeIntContract;

        $contractMock->code = 'GBP';

        $contractMock->number = 826;

        $contractMock->decimal = 2;

        $contractMock->currency = 'Libra Esterlina';
        
        $contractMock
        ->currencyLocations[0] = 'Reino Unido';

        $contractMock
        ->currencyLocations[1] = 'Ilha de Man';

        $contractMock
        ->currencyLocations[2] = 'Guernesey';

        $contractMock
        ->currencyLocations[3] = 'Jersey';
        
        $contractMock
        ->icons[0] = "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Flag_of_the_United_Kingdom.svg/22px-Flag_of_the_United_Kingdom.svg.png";

        $contractMock
        ->icons[1] = '';

        $contractMock
        ->icons[2] = '';

        $contractMock
        ->icons[3] = '';

        assertTrue(
            $interactor->interactorContract == $contractMock
        );
    }

    public function test_4(): void
    {
        $interactor = new ByCodeInteractor('GEL');

        $contractMock = new ByCodeIntContract;

        $contractMock->code = 'GEL';

        $contractMock->number = 981;

        $contractMock->decimal = 2;

        $contractMock->currency = 'Lari';
        
        $contractMock
        ->currencyLocations[0] = 'Geórgia';
        
        $contractMock
        ->icons[0] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Flag_of_Georgia.svg/22px-Flag_of_Georgia.svg.png';

        assertTrue(
            $interactor->interactorContract == $contractMock
        );
    }
}
