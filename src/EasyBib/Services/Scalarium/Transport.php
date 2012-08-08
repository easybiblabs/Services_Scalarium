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
    protected $endpoint = '';
    protected $accept = '';
    protected $token = '';
    protected $request = null;


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
     * Sets the request.
     *
     * @param object $request HTTP_Request2 object (or similar for testing)
     *
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }


    /**
     * Retrieves a document body from their API.
     *
     * @param string $path the relative path for the API call
     *
     * @return string
     *
     * @throws \RuntimeException when another exception occurred in send()
     * @throws \RuntimeException when the returned HTTP status isn't 200
     * @throws \RuntimeException when the returned document body is empty
     */
    public function retrieveAPIData($path)
    {
        if (null === $this->request) {
            $this->request = new \HTTP_Request2;
        }

        $request = $this->request;
        $request->setUrl($this->endpoint . $path);
        $request->setConfig('ssl_verify_peer', false)
        // if you verify SSL, it will throw errors
            ->setHeader('Accept: ' . $this->accept)
            ->setHeader('X-Scalarium-Token: ' . $this->token);

        try {
            $response = $request->send();
        } catch (\Exception $e) {
            throw new \RuntimeException(
                'error occurred in send(): ' .
                $e->getMessage()
            );
        }

        if ($response->getStatus() != '200') {
            throw new \RuntimeException(
                'http status=' .
                $response->getStatus() .
                ', document body=' .
                $response->getBody()
            );
        }

        $body = $response->getBody();
        if (empty($body)) {
            throw new \RuntimeException('document body is empty');
        }
        return $body;
    }


    /**
     * Retrieves protected data in the object.
     *
     * @param string $name what to retrieve
     *
     * @return string
     *
     * @throws \RuntimeException When the $name isn't recognized.
     */
    public function __get($name)
    {
        switch ($name) {
        case 'endpoint':
            return $this->endpoint;
            break;
        case 'accept':
            return $this->accept;
            break;
        case 'token':
            return $this->token;
            break;
        default:
            throw new \RuntimeException("can't access $name");
            break;
        }
    }
}

