<?php

namespace App\UseCases\CrawlIso4217;

use App\UseCases\CrawlIso4217\Contracts\InputContract;
use App\UseCases\CrawlIso4217\Contracts\InteractorContract;

class Interactor
{
    public InteractorContract $interactorContract;

    public function __construct(InputContract $inputContract)
    {
        $this->interactorContract = new InteractorContract;

        $this->interactorContract->interactorContracts = [];

        if ($inputContract->byCode === true) {

            foreach ($inputContract->codes as $key => $code) {

                $byCodeInteractor = new ByCodeInteractor($code);

                $this->interactorContract->interactorContracts[$key] 
                    = $byCodeInteractor->interactorContract;
            }
        }

        if ($inputContract->byCode === false) {

            foreach ($inputContract->numbers as $key => $number) {

                $byNumberInteractor = new ByNumberInteractor($number);

                $this->interactorContract->interactorContracts[$key] 
                    = $byNumberInteractor->interactorContract;
            }
        }
    }
}
