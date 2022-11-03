<?php

namespace App\UseCases\CrawlIso4217\Contracts;

class ByCodeIntContract
{
    public string $code;
    public int $number;
    public int $decimal;
    public string $currency;
    public array $currencyLocations;
    public array $icons;
}
