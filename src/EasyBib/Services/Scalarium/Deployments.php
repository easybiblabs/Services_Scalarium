<?php

namespace EasyBib\Services\Scalarium;
use \EasyBib\Services\Scalarium;
use \EasyBib\Services\Scalarium\Applications;
use \EasyBib\Services\Scalarium\Clouds;

class Deployments extends Scalarium
{
    function getDeployments()
    {
        $deployments = array();
        $applications = new Applications($this->_endpoint, $this->_accept, $this->_token);
        $applicationsData = $applications->getApplications();
        foreach ($applicationsData as $oneApplication) {
            $deployments[ $oneApplication['id'] ] = $applications->getDeploymentsByApplication($oneApplication['id']);
        }
        return $deployments;
    }
}
