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
 * Roles
 *
 * This class lets you retrieve information about roles.
 *
 * @category EasyBib
 * @package  EasyBib_Services_Scalarium
 * @author   Ulf Härnhammar <ulfharn@gmail.com>
 * @license  http://opensource.org/licenses/bsd-license.php New BSD License
 * @version  Release: @package_version@
 * @link     http://www.easybib.com
 */
class Roles extends Scalarium
{
    protected $token = '';
    protected $cloud = '';


    /**
     * the constructor
     *
     * @param string $token the Scalarium API token
     * @param string $cloud the cloud ID
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException when a parameter is empty
     */
    public function __construct($token, $cloud)
    {
        if ((empty($token)) || (empty($cloud))) {
            throw new \InvalidArgumentException("can't be empty");
        }
        $this->token = $token;
        $this->cloud = $cloud;
    }


    /**
     * Retrieves all roles in one cloud from their API.
     *
     * @return array parsed JSON
     */
    public function get()
    {
        return $this->retrieveAPIParseJSON(
            'clouds/' . $this->cloud . '/roles'
        );
    }
}

