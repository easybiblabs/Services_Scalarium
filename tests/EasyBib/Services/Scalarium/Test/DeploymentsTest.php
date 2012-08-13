<?php

namespace EasyBib\Services\Scalarium\Test;

use \EasyBib\Services\Scalarium\Deployments;

class DeploymentsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDeployments()
    {
        $stub = $this->getMock('\EasyBib\Services\Scalarium\Deployments',
                               array('getApplications', 'getDeploymentsByApplication'),
                               array('token'));
        $inApp = array(
                    array('id' => 1),
                    array('id' => 3),
                    array('id' => 7),
                    array('id' => 5)
                   );
        $inDep = array('data' => 'x', 'info' => 'y');
        $out = array(1 => $inDep, 3 => $inDep, 7 => $inDep, 5 => $inDep);
        $stub->expects($this->any())
            ->method('getApplications')
            ->will($this->returnValue($inApp));
        $stub->expects($this->any())
            ->method('getDeploymentsByApplication')
            ->will($this->returnValue($inDep));
        $this->assertEquals($out, $stub->getDeployments());
    }
}

