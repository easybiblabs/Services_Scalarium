<?php

namespace EasyBib\Services\Scalarium\Test;

use \EasyBib\Services\Scalarium\Applications;

class ApplicationsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetApplicationsCorrect()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Applications', array('retrieveAPI'),
                               array('endpoint', 'accept', 'token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue('["test"]'));
        $this->assertEquals(array('test'), $stub->getApplications());
    }


    public function testGetApplicationsFalse()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Applications', array('retrieveAPI'),
                               array('endpoint', 'accept', 'token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue(false));
        $this->assertEquals(false, $stub->getApplications());
    }


    public function testGetApplicationsBadJSON()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Applications', array('retrieveAPI'),
                               array('endpoint', 'accept', 'token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue('["test]'));
        $this->assertEquals(false, $stub->getApplications());
    }


    public function testGetDeploymentsByApplicationCorrect()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Applications', array('retrieveAPI'),
                               array('endpoint', 'accept', 'token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue('["test"]'));
        $this->assertEquals(array('test'), $stub->getDeploymentsByApplication('app01'));
    }


    public function testGetDeploymentsByApplicationFalse()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Applications', array('retrieveAPI'),
                               array('endpoint', 'accept', 'token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue(false));
        $this->assertEquals(false, $stub->getDeploymentsByApplication('app01'));
    }


    public function testGetDeploymentsByApplicationBadJSON()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Applications', array('retrieveAPI'),
                               array('endpoint', 'accept', 'token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue('["test]'));
        $this->assertEquals(false, $stub->getDeploymentsByApplication('app01'));
    }
}

