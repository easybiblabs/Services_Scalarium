<?php

namespace EasyBib\Services\Scalarium;
use \EasyBib\Services\Scalarium;

class Clouds extends Scalarium
{
    function getClouds()
    {
        $cloudJson = $this->retrieveApi('clouds');
        if ($cloudJson === false) {
            return false;
        }
        $cloudParsedJson = json_decode($cloudJson, true);
        return $cloudParsedJson;
    }
}
