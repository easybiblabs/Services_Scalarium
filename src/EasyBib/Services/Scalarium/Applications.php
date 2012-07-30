<?php

namespace EasyBib\Services\Scalarium;
use \EasyBib\Services\Scalarium;

class Applications extends Scalarium
{
    function getApplications()
    {
        return $this->retrieveAPIParseJSON('applications');
    }


    function getDeploymentsByApplication($applicationID)
    {
        return $this->retrieveAPIParseJSON("applications/$applicationID/deployments");
    }
}
