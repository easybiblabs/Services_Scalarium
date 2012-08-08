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
        $this->endpoint = $endpoint;
        $this->token = $token;
    }


    /**
     * Retrieves a document body from their API.
     *
     * @param string $path the relative path for the API call
     *
     * @return mixed string (document body) or bool (false = error occurred)
     */
    protected function retrieveAPI($path)
    {
        $transport = new Transport($this->endpoint, $this->accept, $this->token);
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
     * @throws \RuntimeException When the API doesn't return a document body.
     * @throws \RuntimeException When the returned document body isn't correct JSON.
     */
    protected function retrieveAPIParseJSON($path)
    {
        $apiJSON = $this->retrieveAPI($path);
        if ($apiJSON === false) {
            throw new \RuntimeException("didn't return a document body");
        }
        $apiParsedJSON = json_decode($apiJSON, true);
        if (!is_array($apiParsedJSON)) {
            throw new \RuntimeException("document body isn't correct JSON=$apiJSON");
        }
        return $apiParsedJSON;
    }
}

