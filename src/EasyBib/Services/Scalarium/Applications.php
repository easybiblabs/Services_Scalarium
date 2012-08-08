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

/**
 * Applications
 *
 * This class lets you retrieve information about applications.
 *
 * @category EasyBib
 * @package  EasyBib_Services_Scalarium
 * @author   Ulf Härnhammar <ulfharn@gmail.com>
 * @license  http://opensource.org/licenses/bsd-license.php New BSD License
 * @version  Release: @package_version@
 * @link     http://www.easybib.com
 */
class Applications extends Scalarium
{
    /**
     * Retrieves all applications from their API.
     *
     * @return array parsed JSON
     */
    public function getApplications()
    {
        return $this->retrieveAPIParseJSON('applications');
    }


    /**
     * Retrieves all deployments of one application from their API.
     *
     * @param string $applicationID ID for the application
     *
     * @return array parsed JSON
     */
    public function getDeploymentsByApplication($applicationID)
    {
        return $this->retrieveAPIParseJSON(
            "applications/$applicationID/deployments"
        );
    }
}

