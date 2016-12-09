<?php
/**
 * Copyright (2016) by phpriak
 * Created by Ivoglent N.
 * Date: 12/9/2016
 * Time: 11:21 PM
 */

namespace ivoglent\phpriak\base;


class RiakSetup
{

    /**
     * Definition for instance
     * @var RiakSetup
     */
    private static $instance = null;
    /**
     * Definition for nodes
     * @var NodeConfig[]
     */
    private $nodes = [];

    /**
     * Definition for isReady
     * @var bool
     */
    private $isReady = false;

    /**
     * addNode
     * @param $host
     * @param $port
     * @param null $username
     * @param null $password
     */
    public function addNode($host, $port, $username = null, $password = null) {
        $node = new NodeConfig();
        $node->setHost($host);
        $node->setPort($port);
        $node->setUsername($username);
        $node->setPassword($password);
        $this->nodes[] = $node;
    }

    /**
     * getNodes
     * @return NodeConfig[]
     */
    public function getNodes(){
        return $this->nodes;
    }

    /**
     * init
     * @param $configs
     */
    public function init($configs) {
        foreach ($configs as $config) {
            if (isset($config['host']) && isset($config['port'])) {
                $this->addNode(
                    $config['host'],
                    $config['port'] ,
                    isset($config['username']) ? $config['username'] : null,
                    isset($config['password']) ? $config['password'] : null
                );
            }
        }
        if (!empty($this->nodes)) {
            $this->isReady = true;
        }
    }

    public function isReady(){
        return $this->isReady;
    }

    /**
     * wakeUp
     * @return RiakSetup
     */
    public static function wakeUp(){
        if (empty(self::$instance)) {
            self::$instance = new RiakSetup();
        }
        return self::$instance;
    }

}