<?php

namespace App\UseCases\CrawlIso4217\Contracts;

class InputContract
{
    /**
     * @var string[]
     */
    public array $codes;
    /**
     * @var int[]
     */
    public array $numbers;
    public bool $byCode;
}
