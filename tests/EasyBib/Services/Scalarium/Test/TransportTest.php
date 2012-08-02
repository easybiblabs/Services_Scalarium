<?php

namespace EasyBib\Services\Scalarium\Transport\Test;

use \EasyBib\Services\Scalarium\Transport;

class TransportTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $transport = new Transport('endpoint', 'accept', 'token');
        $this->assertEquals($transport->endpoint, 'endpoint');
        $this->assertEquals($transport->accept, 'accept');
        $this->assertEquals($transport->token, 'token');
    }
}

