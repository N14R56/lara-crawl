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
                "currency_locations" => [
                    0 => [
                        "location" => $contract->currencyLocations[0],
                        "icon" => "https://upload.wikimedia.org/
                            wikipedia/commons/thumb/a/ae/
                            Flag_of_the_United_Kingdom.svg/
                            22px-Flag_of_the_United_Kingdom.svg.png"
                    ],
                    1 => [
                        "location" => "Ilha de Man",
                        "icon" => ""
                    ],
                    2 => [
                        "location" => "Guernesey",
                        "icon" => ""
                    ],
                    3 => [
                        "location" => "Jersey",
                        "icon" => ""
                    ]
                ]
            ];
        }

        return $array;
    }
}
