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
 * Instances
 *
 * This class lets you retrieve information about instances.
 *
 * @category EasyBib
 * @package  EasyBib_Services_Scalarium
 * @author   Ulf Härnhammar <ulfharn@gmail.com>
 * @license  http://opensource.org/licenses/bsd-license.php New BSD License
 * @version  Release: @package_version@
 * @link     http://www.easybib.com
 */
class Instances extends Scalarium
{
    protected $cloud = '';
    protected $role = '';


    /**
     * the constructor
     *
     * @param string $token the Scalarium API token
     * @param string $cloud the cloud ID
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException when the token is empty
     */
    public function __construct($token, $cloud)
    {
        if (empty($token)) {
            throw new \InvalidArgumentException("token can't be empty");
        }
        $this->token = $token;
        $this->setCloud($cloud);
    }


    /**
     * Sets the cloud.
     *
     * @param string $cloud the cloud ID
     *
     * @return Instances
     *
     * @throws \InvalidArgumentException when the cloud is empty
     */
    public function setCloud($cloud)
    {
        if (empty($cloud)) {
            throw new \InvalidArgumentException("cloud can't be empty");
        }
        $this->cloud = $cloud;
        return $this;
    }


    /**
     * Sets the role.
     *
     * @param string $role the role ID
     *
     * @return Instances
     *
     * @throws \InvalidArgumentException when the role is empty
     */
    public function setRole($role)
    {
        if (empty($role)) {
            throw new \InvalidArgumentException("role can't be empty");
        }
        $this->role = $role;
        return $this;
    }


    /**
     * Retrieves all instances in the cloud - and optionally role - from their API.
     *
     * @return array parsed JSON
     */
    public function get()
    {
        $path = 'clouds/' . $this->cloud;
        if (!empty($this->role)) {
            $path .= '/roles/' . $this->role;
        }
        $path .= '/instances';
        return $this->retrieveAPIParseJSON($path);
    }
}

