<?php

namespace App\UseCases\CrawlIso4217\DomainEntities;

use DOMElement;
use DOMNamedNodeMap;
use DOMNodeList;

class NodeExtractor
{
    public string $code;
    public int $number;
    public int $decimal;
    public string $currency;
    public array $currencyLocations;
    public array $icons;

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

                    $this->setCurrencyLocations(
                        $domNodeList[$key + 4]
                    );
                }
            }
            
            $i++;
            
            if ($i === 5) {
                
                $i = 0;
                
            }
        }
    }
    
    private function setCurrencyLocations(
        DOMElement $element
    ): void
    {
        $i = 0;
        foreach($element->childNodes as $k => $child) {

            if (isset($child->tagName)) {

                if ($child->tagName === 'img') {
                    
                    $icon = $this->icon($child->attributes);
                }

                if ($child->tagName === 'a') {

                    $this->currencyLocations[$i] = $this->sanitize($child->textContent);

                    if (isset($icon)) {

                        $this->icons[$i] = $icon;

                        unset($icon);

                    } else {

                        $this->icons[$i] = '';

                    }

                    $i++;
                }
            }
        }
    }

    public function icon(
        DOMNamedNodeMap $attributes
    ): string
    {
        foreach($attributes as $key => $value) {

            if ($key === 'src') {

                return 'https:' . $value->value;

            }   
        }
    }

    private function sanitize(string $locations): string
    {
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
