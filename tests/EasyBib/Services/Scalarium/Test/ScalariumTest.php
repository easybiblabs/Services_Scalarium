<?php

namespace EasyBib\Services\Scalarium\Test;

use \EasyBib\Services\Scalarium\Clouds;

class ScalariumTest extends \PHPUnit_Framework_TestCase
// we can't test Scalarium directly, because it's abstract
// so we'll test Clouds instead
{
    public function testConstruct()
    {
        $clouds = new Clouds('endpoint', 'accept', 'token');
        $this->assertEquals($clouds->endpoint, 'endpoint');
        $this->assertEquals($clouds->accept, 'accept');
        $this->assertEquals($clouds->token, 'token');
    }
}

