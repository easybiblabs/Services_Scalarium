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

use \HTTP_Request2;

/**
 * Transport
 *
 * This class communicates with Scalarium's web servers to retrieve information.
 *
 * @category EasyBib
 * @package  EasyBib_Services_Scalarium
 * @author   Ulf Härnhammar <ulfharn@gmail.com>
 * @license  http://opensource.org/licenses/bsd-license.php New BSD License
 * @version  Release: @package_version@
 * @link     http://www.easybib.com
 */
class Transport
{
    public $endpoint = '';
    public $accept = '';
    public $token = '';


    /**
     * __construct
     *
     * @param string $endpoint the endpoint URL for their API
     * @param string $accept   the Accept HTTP header that selects API version
     * @param string $token    the Scalarium token
     *
     * @return $this
     */
    public function __construct($endpoint, $accept, $token)
    {
        $this->endpoint = $endpoint;
        $this->accept = $accept;
        $this->token = $token;
    }


    /**
     * Retrieves a document body from their API. If the HTTP status differs from
     * 200 or if an exception is thrown, the document body will be thrown away
     * and we will return false instead.
     *
     * @param string $path the relative path for the API call
     *
     * @return mixed string or bool (false = error occurred while fetching)
     */
    public function retrieveAPIData($path)
    {
        $request = new HTTP_Request2($this->endpoint . $path);
        $requestWorked = true;
        $request->setConfig('ssl_verify_peer', false)
        // if you verify SSL, it will throw errors
            ->setHeader('Accept: ' . $this->accept)
            ->setHeader('X-Scalarium-Token: ' . $this->token);

        try {
            $response = $request->send();
        } catch (\Exception $e) {
            $requestWorked = false;
        }

        if ($requestWorked and ($response->getStatus() != '200')) {
            $requestWorked = false;
        }

        if (!$requestWorked) {
            return false;
        }

        return $response->getBody();
    }
}

