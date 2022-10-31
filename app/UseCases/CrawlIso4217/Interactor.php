<?php

namespace App\UseCases\CrawlIso4217;

use App\UseCases\CrawlIso4217\Contracts\InputContract;
use App\UseCases\CrawlIso4217\Contracts\InteractorContract;
use DOMDocument;
use DOMNodeList;
use DOMXPath;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleHttpClient;
use Symfony\Component\HttpClient\HttpClient;

class Interactor
{
    public InteractorContract $interactorContract;

    public function __construct(InputContract $inputContract)
    {     
        $this->analyzeReq();
    }

    public function request(): DOMNodeList
    {
        $client = new GuzzleHttpClient();

        $response = $client->get('https://pt.wikipedia.org/wiki/ISO_4217');

        $htmlString = (string) $response->getBody();

        libxml_use_internal_errors(true);

        $doc = new DOMDocument();

        $doc->loadHTML($htmlString);
        
        $xpath = new DOMXPath($doc);

        return $xpath->evaluate(
            '//*[@id="mw-content-text"]/div[1]/table[3]/tbody/tr'
        );
    }

    public function analyzeReq(): void
    {
        $this->interactorContract = new InteractorContract;

        foreach ($this->request() as $title) {
            
            $sub = substr($title->textContent, 40, 30);

            $extractedTitles[] = $title->textContent.PHP_EOL;

            if (isset($extractedTitles[1])) {

                $codeFound = substr($title->textContent, 1, 3);

                if ($codeFound === 'HKD') {
                    
                    $codeFound = substr($title->textContent, 1, 3);

                    $this->interactorContract->code = $codeFound;


                    $numberFound = substr($title->textContent, 5, 3);

                    $this->interactorContract->number = $numberFound;

                    
                    $decimalFound = substr($title->textContent, 9, 1);

                    $this->interactorContract->decimal = $decimalFound;


                    $currency = substr($title->textContent, 11, 19);

                    $this->interactorContract->currency = $currency;


                    $location = substr($title->textContent, 33, 9);
                
                    $this->interactorContract->currencyLocation[0] = $location;
                }
            }
        }

        // dd($this->interactorContract);
    }
}
