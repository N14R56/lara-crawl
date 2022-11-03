<?php

namespace App\UseCases\CrawlIso4217;

use App\UseCases\CrawlIso4217\ApplicationEntities\DOMNodeFetcher;
use App\UseCases\CrawlIso4217\Contracts\ByNumberIntContract;
use App\UseCases\CrawlIso4217\DomainEntities\NodeExtractorNumb;

class ByNumberInteractor
{
    public ByNumberIntContract $interactorContract;

    public function __construct(string $number)
    {     
        $this->interactorContract = new ByNumberIntContract;

        $domNodeList = DOMNodeFetcher::fetch(
            'https://pt.wikipedia.org/wiki/ISO_4217',
            '//*[@id="mw-content-text"]/div[1]/table[3]/tbody/tr/td'
        );

        $nodeExtractor = new NodeExtractorNumb(
            $domNodeList,
            $number
        );

        $this->interactorContract
        ->code = $nodeExtractor->code;

        $this->interactorContract
        ->number = $nodeExtractor->number;

        $this->interactorContract
        ->decimal = $nodeExtractor->decimal;

        $this->interactorContract
        ->currency = $nodeExtractor->currency;

        $this->interactorContract
        ->currencyLocations = $nodeExtractor->currencyLocations;

        $this->interactorContract
        ->icons = $nodeExtractor->icons;
    }
}
