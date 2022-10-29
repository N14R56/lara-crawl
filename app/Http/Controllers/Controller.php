<?php

namespace App\Http\Controllers;

use App\UseCases\CrawlIso4217\Adapter;
use App\UseCases\CrawlIso4217\Interactor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function iso4217(Request $request): Response
    {
        $adapter = new Adapter($request);

        if ($adapter->validInputContract === true) {

            $interactor = new Interactor($adapter->inputContract);

            $adapter->setInteractorContract($interactor->interactorContract);
        }

        return $adapter->laravelResponse();
    }
}
