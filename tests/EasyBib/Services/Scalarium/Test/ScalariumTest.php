<?php

namespace EasyBib\Services\Scalarium\Test;

use \EasyBib\Services\Scalarium\Clouds;

class ScalariumTest extends \PHPUnit_Framework_TestCase
// we can't test Scalarium directly, because it's abstract
// so we'll test Clouds instead
{
    public function testConstruct()
    {
        $clouds = new Clouds('_token_');
        $this->assertEquals($clouds->endpoint, 'https://manage.scalarium.com/api/');
        $this->assertEquals($clouds->accept, 'application/vnd.scalarium-v1+json');
        $this->assertEquals($clouds->token, '_token_');
    }
}

