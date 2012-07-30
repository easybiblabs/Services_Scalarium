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


    function retrieveAPI($path)
    {
        $transport = new Transport($this->_endpoint, $this->_accept, $this->_token);
        return $transport->retrieveAPIData($path);
    }


    function retrieveAPIParseJSON($path)
    {
        $apiJSON = $this->retrieveAPI($path);
        if ($apiJSON === false) {
            return false;
        }
        $apiParsedJSON = json_decode($apiJSON, true);
        return $apiParsedJSON;
    }
}
