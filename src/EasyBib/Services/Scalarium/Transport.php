<?php

namespace EasyBib\Services\Scalarium;
use \HTTP_Request2;

class Transport
{
    private $_endpoint = '';
    private $_token = '';
    private $_accept = '';


    function __construct($endpoint, $accept, $token)
    {
        $this->_endpoint = $endpoint;
        $this->_token = $token;
        $this->_accept = $accept;
    }


    function retrieveApiData($path)
    {
        $request = new HTTP_Request2($this->_endpoint . $path);
        $requestWorked = true;
        $request->setConfig('ssl_verify_peer', false) // if you verify SSL it will throw errors
            ->setHeader('Accept: ' . $this->_accept)
            ->setHeader('X-Scalarium-Token: ' . $this->_token);

        try {
            $response = $request->send();
        } catch (\Exception $e) {
            $requestWorked = false;
        }

        if ( ($requestWorked) and ($response->getStatus() != '200') ) {
            $requestWorked = false;
        }

        if (!$requestWorked) {
            return false;
        }

        return $response->getBody();
    }
}
