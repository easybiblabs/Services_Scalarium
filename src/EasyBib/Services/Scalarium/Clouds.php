<?php

/**
 * PHP wrapper for the Scalarium API
 *
 * PHP Version 5
 *
 * @category EasyBib
 * @package  EasyBib_Services_Scalarium
 * @author   Ulf Härnhammar <ulfharn@gmail.com>
 * @license  http://opensource.org/licenses/bsd-license.php New BSD License
 * @version  SVN: $Id$
 * @link     http://www.easybib.com
 */

namespace EasyBib\Services\Scalarium;

use \EasyBib\Services\Scalarium;
use \EasyBib\Services\Scalarium\Applications;

/**
 * Clouds
 *
 * This class lets you retrieve information about clouds.
 *
 * @category EasyBib
 * @package  EasyBib_Services_Scalarium
 * @author   Ulf Härnhammar <ulfharn@gmail.com>
 * @license  http://opensource.org/licenses/bsd-license.php New BSD License
 * @version  Release: @package_version@
 * @link     http://www.easybib.com
 */
class Clouds extends Scalarium
{
    /**
     * Retrieves all clouds from their API.
     *
     * @return array parsed JSON
     */
    public function getClouds()
    {
        return $this->retrieveAPIParseJSON('clouds');
    }


    /**
     * Retrieves all applications from their API.
     *
     * @return array parsed JSON
     */
    public function getApplications()
    {
        $applications = new Applications($this->token);
        return $applications->getApplications();
    }


    /**
     * Retrieves all applications in one cloud from their API.
     *
     * @param string $cloudID ID for the cloud
     *
     * @return array parsed JSON
     *
     * @throws \InvalidArgumentException when $cloudID is empty
     */
    public function getApplicationsInCloud($cloudID)
    {
        if (empty($cloudID)) {
            throw new \InvalidArgumentException("cloudID can't be empty");
        }
        $applicationsData = $this->getApplications();
        $applicationsInCloud = array();
        if (is_array($applicationsData)) {
            foreach ($applicationsData as $oneApplication) {
                if ($oneApplication['cluster_id'] == $cloudID) {
                    $applicationsInCloud[] = $oneApplication;
                }
            }
        }
        return $applicationsInCloud;
    }
}

