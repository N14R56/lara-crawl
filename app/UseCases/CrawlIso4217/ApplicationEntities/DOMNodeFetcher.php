<?php

namespace App\UseCases\CrawlIso4217\ApplicationEntities;

use DOMDocument;
use DOMNodeList;
use DOMXPath;
use GuzzleHttp\Client;

class DOMNodeFetcher
{
    public static function fetch(
        string $url,
        string $xPath
    ): DOMNodeList
    {
        $client = new Client();

        $response = $client->get($url);

        $htmlString = (string) $response->getBody();

        libxml_use_internal_errors(true);

        $doc = new DOMDocument();

        $doc->loadHTML($htmlString);
        
        $xpath = new DOMXPath($doc);

        return $xpath->evaluate(
            $xPath
        );
    }
}
