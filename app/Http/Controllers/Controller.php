<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function iso4217(): Response
    {
        return response(
            [
                0 => [
                    "code" => "GBP",
                    "number" => 826,  
                    "decimal" => 2,  
                    "currency" => "Libra Esterlina",  
                    "currency_locations" => [
                        0 => [
                            "location" => "Reino Unido",  
                            "icon" => "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Flag_of_the_United_Kingdom.svg/22px-Flag_of_the_United_Kingdom.svg.png"
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
                ]
            ],
            200
        );
    }
}
