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

namespace EasyBib\Services;

use \EasyBib\Services\Scalarium\Transport;
use \HTTP_Request2;

/**
 * Scalarium
 *
 * This is the abstract class that the other classes extend.
 *
 * @category EasyBib
 * @package  EasyBib_Services_Scalarium
 * @author   Ulf Härnhammar <ulfharn@gmail.com>
 * @license  http://opensource.org/licenses/bsd-license.php New BSD License
 * @version  Release: @package_version@
 * @link     http://www.easybib.com
 */
abstract class Scalarium
{
    protected $endpoint = '';
    protected $accept = 'application/vnd.scalarium-v1+json';
    protected $token = '';


    /**
     * __construct
     *
     * @param string $endpoint the endpoint URL for their API
     * @param string $token    the Scalarium token
     *
     * @return $this
     */
    public function __construct($endpoint, $token)
    {
        $this->__set('endpoint', $endpoint);
        $this->__set('token', $token);
    }


    /**
     * Retrieves a document body from their API.
     *
     * @param string $path the relative path for the API call
     *
     * @return string document body
     */
    protected function retrieveAPI($path)
    {
        $transport = new Transport($this->endpoint, $this->accept, $this->token);
        $request = new \HTTP_Request2;
        $transport->setRequest($request);
        return $transport->retrieveAPIData($path);
    }


    /**
     * Retrieves a document body from their API and parses it as JSON to array
     * format.
     *
     * @param string $path the relative path for the API call
     *
     * @return array (parsed JSON)
     *
     * @throws \RuntimeException When the returned document body isn't correct JSON.
     */
    protected function retrieveAPIParseJSON($path)
    {
        $apiJSON = $this->retrieveAPI($path);
        $apiParsedJSON = json_decode($apiJSON, true);
        if (!is_array($apiParsedJSON)) {
            throw new \RuntimeException("document body isn't correct JSON=$apiJSON");
        }
        return $apiParsedJSON;
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
        case 'token':
            return $this->token;
            break;
        case 'accept':
            return $this->accept;
            break;
        default:
            throw new \RuntimeException("can't access $name");
            break;
        }
    }


    /**
     * Stores protected data in the object after sanity-checking its value.
     *
     * @param string $name  where to store
     * @param string $value what to store
     *
     * @return mixed
     *
     * @throws \RuntimeException When the $name isn't recognized or the $value
     *                           isn't accepted.
     */
    public function __set($name, $value)
    {
        switch ($name) {
        case 'endpoint':
            if (!preg_match('%^https?://.%', $value)) {
                throw new \RuntimeException(
                    "endpoint isn't recognized as a url: $value"
                );
            }
            $this->endpoint = $value;
            break;
        case 'token':
            if (empty($value)) {
                throw new \RuntimeException('token must not be empty');
            }
            $this->token = $value;
            break;
        case 'accept':
            if (empty($value)) {
                throw new \RuntimeException('accept must not be empty');
            }
            $this->accept = $value;
            break;
        default:
            throw new \RuntimeException("can't access $name");
            break;
        }
    }
}

