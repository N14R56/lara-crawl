<?php

namespace App\UseCases\CrawlIso4217;

use App\UseCases\CrawlIso4217\ApplicationEntities\DOMNodeFetcher;
use App\UseCases\CrawlIso4217\DomainEntities\NodeExtractor;
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

        $nodeExtractor = new NodeExtractor(
            $domNodeList,
            $code
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
    }
}
