<?php

namespace App\UseCases\CrawlIso4217\DomainEntities;

use DOMNodeList;

class NodeExtractor
{
    public string $code;
    public int $number;
    public int $decimal;
    public string $currency;
    public array $currencyLocations;

    public function __construct(
        DOMNodeList $domNodeList,
        string $code
    )
    {
        $i = 0;
        
        foreach ($domNodeList as $key => $node) {
            
            if ($i === 0) {
                
                $codeFound = $node->textContent;

                if ($codeFound === $code) {

                    $this->code = $codeFound;


                    $numberFound = $domNodeList[$key + 1]->textContent;
                    $this->number = $numberFound;


                    $decimalFound = $domNodeList[$key + 2]->textContent;
                    $this->decimal = $decimalFound;


                    $currency = $domNodeList[$key + 3]->textContent;
                    $this->currency = $currency;

                    $locations = $domNodeList[$key + 4]->textContent;
                    $this->setCurrencyLocations($locations);
                    
                }
            }
            
            $i++;
            
            if ($i === 5) {
                
                $i = 0;
                
            }
        }
    }
    
    private function setCurrencyLocations(string $locations): void
    {
        $locations = $this->sanitize($locations);
        
        $locArray = explode(', ', $locations);

        foreach ($locArray as $key => $loc) {

            $this->currencyLocations[$key] = $loc;

        }
    }

    private function sanitize(string $locations): string
    {
        $locations = substr(
            $locations,
            2
        );

        $locations = rtrim(
            $locations
        );

        $locations = str_replace(
            "\r\n",
            "",
            $locations
        );

        return str_replace(
            "\n",
            "",
            $locations
        );
    }
}
