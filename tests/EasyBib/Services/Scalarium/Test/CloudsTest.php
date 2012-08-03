<?php

namespace EasyBib\Services\Scalarium\Test;

use \EasyBib\Services\Scalarium\Clouds;

class CloudsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCloudsCorrect()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Clouds', array('retrieveAPI'),
                               array('endpoint', 'accept', 'token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue('["test2"]'));
        $this->assertEquals(array('test2'), $stub->getClouds());
    }


    public function testGetCloudsFalse()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Clouds', array('retrieveAPI'),
                               array('endpoint', 'accept', 'token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue(false));
        $this->assertEquals(false, $stub->getClouds());
    }


    public function testGetCloudsBadJSON()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Clouds', array('retrieveAPI'),
                               array('endpoint', 'accept', 'token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue('["test2]'));
        $this->assertEquals(false, $stub->getClouds());
    }
}

