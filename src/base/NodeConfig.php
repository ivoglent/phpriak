<?php
/**
 * Copyright (2016) by phpriak
 * Created by Ivoglent N.
 * Date: 12/9/2016
 * Time: 11:22 PM
 */

namespace ivoglent\phpriak\base;


class NodeConfig
{
    /**
     * Definition for _host
     * @var string
     */
    private $_host;
    /**
     * Definition for _port
     * @var integer
     */
    private $_port;

    /**
     * Definition for _username
     * @var string
     */
    private $_username;

    /**
     * Definition for _password
     * @var string
     */
    private $_password;

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->_host = $host;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->_port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->_port = $port;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }


}