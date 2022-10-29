<?php

namespace App\UseCases\CrawlIso4217;

use App\UseCases\CrawlIso4217\Contracts\InputContract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Adapter
{
    public InputContract $inputContract;

    public function __construct(Request $request)
    {
        $this->setInputContract($request);
    }

    private function setInputContract(Request $request)
    {
        $this->inputContract = new InputContract();

        if (isset($request->post()['code_list'])) {

            $this->inputContract->codeList = $request->post()['code_list'];
            $this->byCode = true;

        }

        if (isset($request->post()['number_list'])) {

            $this->inputContract->numberList = $request->post()['number_list'];
            $this->byCode = false;

        }
    }

    public function laravelResponse(): Response
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
