<?php

namespace App\UseCases\CrawlIso4217\Contracts;

class InputContract
{
    /**
     * @var string[]
     */
    public array $codeList;
    /**
     * @var int[]
     */
    public array $numberList;
    public bool $byCode;
}
