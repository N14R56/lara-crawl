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

        $i = 0;
        
        foreach ($domNodeList as $key => $node) {
            
            if ($i === 0) {
                
                $codeFound = $node->textContent;

                if ($codeFound === $code) {

                    $this->interactorContract->code = $codeFound;


                    $numberFound = $domNodeList[$key + 1]->textContent;
                    $this->interactorContract->number = $numberFound;


                    $decimalFound = $domNodeList[$key + 2]->textContent;
                    $this->interactorContract->decimal = $decimalFound;


                    $currency = $domNodeList[$key + 3]->textContent;
                    $this->interactorContract->currency = $currency;


                    $location = $domNodeList[$key + 4]->textContent;
                    $this->interactorContract->currencyLocation[0] = $location;
                }
            }
            
            $i++;
            
            if ($i === 5) {
                
                $i = 0;
                
            }
        }
    }
}
