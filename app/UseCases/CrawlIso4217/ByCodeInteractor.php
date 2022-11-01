<?php

namespace App\UseCases\CrawlIso4217;

use App\UseCases\CrawlIso4217\ApplicationEntities\DOMNodeFetcher;
use App\UseCases\CrawlIso4217\Contracts\ByCodeIntContract;


class ByCodeInteractor
{
    public ByCodeIntContract $interactorContract;

    public function __construct(string $code)
    {     
        $this->interactorContract = new ByCodeIntContract;

        $domNodeList = DOMNodeFetcher::fetch(
            'https://pt.wikipedia.org/wiki/ISO_4217',
            '//*[@id="mw-content-text"]/div[1]/table[3]/tbody/tr/td'
        );

        // dd($domNodeList);
        
        foreach ($domNodeList as $node) {

            var_dump($node->textContent);

            $i[] = $node->textContent;
            
            if (isset($i[1])) {
                
                $codeFound = substr($node->textContent, 1, 3);
                
                if ($codeFound === $code) {
                    
                    $this->interactorContract->code = $codeFound;
                    // dd($this->interactorContract->code);

                    $numberFound = substr($node->textContent, 5, 3);

                    $this->interactorContract->number = $numberFound;

                    
                    $decimalFound = substr($node->textContent, 9, 1);

                    $this->interactorContract->decimal = $decimalFound;


                    $currency = substr($node->textContent, 11, 19);

                    $this->interactorContract->currency = $currency;


                    $location = substr($node->textContent, 33, 9);
                
                    $this->interactorContract->currencyLocation[0] = $location;
                }
            }
        }
        // dd($this->interactorContract);
    }
}
