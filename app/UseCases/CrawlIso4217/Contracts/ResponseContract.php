<?php

namespace App\UseCases\CrawlIso4217Contracts;

class ResponseContract
{
    public string $code;
    public int $number;
    public int $decimal;
    public string $currency;
    public array $currencyLocations;
}
