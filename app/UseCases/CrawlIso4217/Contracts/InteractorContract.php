<?php

namespace App\UseCases\CrawlIso4217\Contracts;

class InteractorContract
{
    public string $code;
    public int $number;
    public int $decimal;
    public string $currency;
    public array $currencyLocations;
}
