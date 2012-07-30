<?php

namespace EasyBib\Services\Scalarium;
use \EasyBib\Services\Scalarium;

class Applications extends Scalarium
{
    function getApplications()
    {
        $appJson = $this->retrieveApi('applications');
        if ($appJson === false) {
            return false;
        }
        $appParsedJson = json_decode($appJson, true);
        return $appParsedJson;
    }
}
