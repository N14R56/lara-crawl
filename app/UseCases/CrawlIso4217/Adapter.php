<?php

namespace App\UseCases\CrawlIso4217;

use App\UseCases\CrawlIso4217\ApplicationEntities\ResponseFormatter;
use App\UseCases\CrawlIso4217\Contracts\InputContract;
use App\UseCases\CrawlIso4217\Contracts\InteractorContract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Adapter
{
    public InputContract $inputContract;
    public InteractorContract $interactorContract;
    public bool $validInputContract;

    public function __construct(Request $request)
    {
        $this->setInputContract($request);
    }

    private function setInputContract(Request $request): void
    {
        $this->inputContract = new InputContract();

        if (isset($request->post()['code_list']) === true) {

            $this->inputContract->codes = $request->post()['code_list'];
            $this->inputContract->byCode = true;
            $this->validInputContract = true;
        }

        if (isset($request->post()['number_list']) === true) {

            $this->inputContract->numbers = $request->post()['number_list'];
            $this->inputContract->byCode = false;
            $this->validInputContract = true;
        }
    }

    public function setinteractorContract(
        InteractorContract $interactorContract
    ): void {
        $this->interactorContract = $interactorContract;
    }

    public function laravelResponse(): Response
    {
        if (!isset($this->interactorContract)) {
            return response(
                '',
                400
            );
        }

        if (isset($this->interactorContract)) {

            return response(
                ResponseFormatter::format(
                    $this->interactorContract->interactorContracts
                ),
                200
            );
        }
    }
}
