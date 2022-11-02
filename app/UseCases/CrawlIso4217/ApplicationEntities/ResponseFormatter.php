<?php

namespace App\UseCases\CrawlIso4217\ApplicationEntities;

use App\UseCases\CrawlIso4217\Contracts\ByCodeIntContract;
use App\UseCases\CrawlIso4217\Contracts\ByNumberIntContract;

class ResponseFormatter
{
    /**
     * @param ByCodeIntContract[]|ByNumberIntContract[] $contracts
     */
    public static function format(array $contracts)
    {
        $array = [];

        foreach ($contracts as $key => $contract) {
            
            $array[$key] = [
                "code" => $contract->code,
                "number" => $contract->number,
                "decimal" => $contract->decimal,
                "currency" => $contract->currency,
                "currency_locations" => self::formatCurrencyLocations(
                    $contract->currencyLocations
                )
            ];
        }

        return $array;
    }

    public static function formatCurrencyLocations(
        array $currencyLocations
    ): array
    {
        $array = [];

        foreach ($currencyLocations as $key => $location) {

            $array2 = [
                "location" => $location,
                "icon" => ""
            ];

            array_push(
                $array,
                $array2
            );
        }

        return $array;
    }
}
