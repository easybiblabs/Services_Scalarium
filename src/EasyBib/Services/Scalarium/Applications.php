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
use \HTTP_Request2;

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
     *
     * @throws \InvalidArgumentException when $applicationID is empty
     */
    public function getDeploymentsByApplication($applicationID)
    {
        if (empty($applicationID)) {
            throw new \InvalidArgumentException("applicationID can't be empty");
        }
        return $this->retrieveAPIParseJSON(
            "applications/$applicationID/deployments"
        );
    }


    /**
     * Deletes an application.
     *
     * @param string $cloudID       ID for the cloud
     * @param string $applicationID ID for the application
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException when a parameter is empty
     * @throws \RuntimeException when the deletion doesn't work
     */
    public function deleteApplication($cloudID, $applicationID)
    {
        if ((empty($cloudID)) or (empty($applicationID))) {
            throw new \InvalidArgumentException("can't be empty");
        }

        try {
            $this->retrieveAPI(
                "clouds/$cloudID/applications/$applicationID",
                \HTTP_Request2::METHOD_DELETE
            );
        } catch (\RuntimeException $e) {
            throw new \RuntimeException(
                'error occurred in retrieveAPI()', 0, $e
            );
        }
    }


    /**
     * Updates an application.
     *
     * @param string $applicationID   ID for the application
     * @param array  $applicationData application data to update
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException when a parameter is empty
     * @throws \InvalidArgumentException when $applicationData is
     *                                   not an array or has no
     *                                   elements
     * @throws \RuntimeException when updating doesn't work
     * @throws \RuntimeException when $applicationData can't be
     *                           converted to JSON
     */
    public function updateApplication($applicationID, $applicationData)
    {
        if ((empty($applicationID)) or (empty($applicationData))) {
            throw new \InvalidArgumentException("can't be empty");
        }

        if (!is_array($applicationData)) {
            throw new \InvalidArgumentException("applicationData isn't an array");
        }

        if (count($applicationData) == 0) {
            throw new \InvalidArgumentException("applicationData has no elements");
        }

        $applicationDataJSON = json_encode($applicationData);
        if ($applicationDataJSON === false) {
            throw new \RuntimeException("can't convert applicationData to JSON");
        }

        try {
            $this->retrieveAPI(
                "applications/$applicationID",
                \HTTP_Request2::METHOD_PUT,
                $applicationDataJSON
            );
        } catch (\RuntimeException $e) {
            throw new \RuntimeException(
                'error occurred in retrieveAPI()', 0, $e
            );
        }
    }
}

