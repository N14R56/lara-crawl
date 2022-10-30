<?php

namespace App\UseCases\CrawlIso4217;

use App\UseCases\CrawlIso4217\Contracts\InputContract;
use App\UseCases\CrawlIso4217\Contracts\InteractorContract;
use DOMDocument;
use DOMXPath;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleHttpClient;
use Symfony\Component\HttpClient\HttpClient;

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

        $client = new GuzzleHttpClient();

        $response = $client->get('https://pt.wikipedia.org/wiki/ISO_4217');

        $htmlString = (string) $response->getBody();

        //add this line to suppress any warnings
        libxml_use_internal_errors(true);

        $doc = new DOMDocument();

        $doc->loadHTML($htmlString);
        
        $xpath = new DOMXPath($doc);

        $titles = $xpath->evaluate('//*[@id="mw-content-text"]/div[1]/table[3]/tbody');
        
        $extractedTitles = [];
          
        foreach ($titles as $title) {
            
            $sub = substr($title->textContent, 40, 30);
    
            dd($sub);
            
            $extractedTitles[] = $title->textContent.PHP_EOL;

            echo $title->textContent.PHP_EOL;

        }

    }
}
