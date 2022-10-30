<?php

namespace App\UseCases\CrawlIso4217;

use App\UseCases\CrawlIso4217\Contracts\InputContract;
use App\UseCases\CrawlIso4217\Contracts\InteractorContract;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleHttpClient;

class Interactor
{
    public InteractorContract $interactorContract;

    public function __construct(InputContract $inputContract)
    {
        $this->interactorContract = new InteractorContract;        

        if ($inputContract->byCode === true) {

            foreach ($inputContract->codes as $code) {
                
                $this->interactorContract->code = $code;

            }
        }
        if ($inputContract->byCode === false) {

            foreach ($inputContract->numbers as $number) {
                
                $this->interactorContract->number = $number;

            }
        }

        $httpClient = new Client();

        $response = $httpClient->request('GET', 'https://pt.wikipedia.org/wiki/ISO_4217');

        dd($response);
    }
}
