<?php

namespace EasyBib\Services;
use \EasyBib\Services\Scalarium\Transport;

abstract class Scalarium {
    private $_endpoint = '';
    private $_token = '';
    private $_accept = '';


    function __construct($endpoint, $accept, $token)
    {
        $this->_endpoint = $endpoint;
        $this->_token = $token;
        $this->_accept = $accept;
    }


    function retrieveApi($path)
    {
        $transport = new Transport($this->_endpoint, $this->_accept, $this->_token);
        return $transport->retrieveApiData($path);
    }
}
