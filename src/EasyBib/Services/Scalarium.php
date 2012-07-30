<?php

namespace EasyBib\Services;
use \EasyBib\Services\Scalarium\Transport;

abstract class Scalarium {
    private $_endpoint = '';
    private $_accept = '';
    private $_token = '';


    function __construct($endpoint, $accept, $token)
    {
        $this->_endpoint = $endpoint;
        $this->_accept = $accept;
        $this->_token = $token;
    }


    function retrieveApi($path)
    {
        $transport = new Transport($this->_endpoint, $this->_accept, $this->_token);
        return $transport->retrieveApiData($path);
    }
}
