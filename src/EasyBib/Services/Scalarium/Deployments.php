<?php

namespace EasyBib\Services\Scalarium;
use \EasyBib\Services\Scalarium;
use \EasyBib\Services\Scalarium\Applications;
use \EasyBib\Services\Scalarium\Clouds;

class Deployments extends Scalarium
{
    function getDeployments()
    {
        $deployments = array('applications' => array(), 'clouds' => array());
        $applications = new Applications($this->_endpoint, $this->_accept, $this->_token);
        $applicationsData = $applications->getApplications();
        foreach ($applicationsData as $oneApplication) {
            $deployments['applications'][ $oneApplication['id'] ] = $applications->getDeploymentsByApplication($oneApplication['id']);
        }
/*
        $clouds = new Clouds($this->_endpoint, $this->_accept, $this->_token);
        $cloudsData = $clouds->getClouds();
        foreach ($cloudsData as $oneCloud) {
            $deployments['clouds'][ $oneCloud['id'] ] = $clouds->getDeploymentsByCloud($oneCloud['id']);
        }
*/
        return $deployments;
    }
}
