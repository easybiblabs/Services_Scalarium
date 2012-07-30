<?php

namespace EasyBib\Services\Scalarium;
use \EasyBib\Services\Scalarium;

class Applications extends Scalarium
{
    function getApplications()
    {
        return $this->retrieveApiParseJSON('applications');
    }


    function getDeploymentsByApplication($applicationID)
    {
        return $this->retrieveApiParseJSON("applications/$applicationID/deployments");
    }
}
