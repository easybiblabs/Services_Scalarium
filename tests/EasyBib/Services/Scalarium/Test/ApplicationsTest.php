<?php

namespace EasyBib\Services\Scalarium\Test;

use \EasyBib\Services\Scalarium\Applications;

class ApplicationsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetApplicationsCorrect()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Applications', array('retrieveAPI'),
                               array('token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue('["test"]'));
        $this->assertEquals(array('test'), $stub->getApplications());
    }


    public function testGetApplicationsFalse()
    {
        $this->setExpectedException('RuntimeException');
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Applications', array('retrieveAPI'),
                               array('token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue(false));
        $stub->getApplications();
    }


    public function testGetApplicationsBadJSON()
    {
        $this->setExpectedException('RuntimeException');
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Applications', array('retrieveAPI'),
                               array('token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue('["test]'));
        $stub->getApplications();
    }


    public function testGetDeploymentsByApplicationCorrect()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Applications', array('retrieveAPI'),
                               array('token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue('["test"]'));
        $this->assertEquals(array('test'), $stub->getDeploymentsByApplication('app01'));
    }


    public function testGetDeploymentsByApplicationFalse()
    {
        $this->setExpectedException('RuntimeException');
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Applications', array('retrieveAPI'),
                               array('token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue(false));
        $stub->getDeploymentsByApplication('app01');
    }


    public function testGetDeploymentsByApplicationBadJSON()
    {
        $this->setExpectedException('RuntimeException');
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Applications', array('retrieveAPI'),
                               array('token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue('["test]'));
        $stub->getDeploymentsByApplication('app01');
    }
}

