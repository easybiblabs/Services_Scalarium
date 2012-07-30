<?php

namespace EasyBib\Services\Scalarium;
use \EasyBib\Services\Scalarium;

class Clouds extends Scalarium
{
    function getClouds()
    {
        return $this->retrieveAPIParseJSON('clouds');
    }
}
