<?php

namespace EasyBib\Services\Scalarium\Test;

use \EasyBib\Services\Scalarium\Clouds;

class CloudsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCloudsCorrect()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Clouds', array('retrieveAPI'),
                               array('token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue('["test2"]'));
        $this->assertEquals(array('test2'), $stub->getClouds());
    }


    public function testGetCloudsFalse()
    {
        $this->setExpectedException('RuntimeException');
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Clouds', array('retrieveAPI'),
                               array('token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue(false));
        $stub->getClouds();
    }


    public function testGetCloudsBadJSON()
    {
        $this->setExpectedException('RuntimeException');
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Clouds', array('retrieveAPI'),
                               array('token'));
        $stub->expects($this->any())
            ->method('retrieveAPI')
            ->will($this->returnValue('["test2]'));
        $stub->getClouds();
    }


    public function testGetApplicationsInCloud()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Clouds', array('getApplications'),
                               array('token'));
        $in = array(
                    array('cluster_id' => 1),
                    array('cluster_id' => 2, 'data' => 'x'),
                    array('cluster_id' => 3),
                    array('cluster_id' => 2, 'data' => 'y')
                   );
        $out = array(array('cluster_id' => 2, 'data' => 'x'),
                     array('cluster_id' => 2, 'data' => 'y'));
        $stub->expects($this->any())
            ->method('getApplications')
            ->will($this->returnValue($in));
        $this->assertEquals($out, $stub->getApplicationsInCloud('2'));
    }
}

