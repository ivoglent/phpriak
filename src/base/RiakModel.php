<?php
/**
 * Riak Base Model
 * Created by Long Nguyen.
 * Contact: ivoglent@gmail.com
 * Project: phpriak
 * Date: 08/12/2016
 * Time: 09:47
 * Version : 1.0.1
 */

namespace ivoglent\phpriak\base;


use Basho\Riak;
use ivoglent\phpriak\interfaces\RiakModelInterface;

abstract class RiakModel implements RiakModelInterface
{
    /** @var  Riak\Bucket */
    protected $bucket;
    /** @var  string */
    protected $key = '';
    /** @var  Riak $riak */
    protected $riak;

    /** @var  Riak\Location */
    protected $location;

    /**
     * @var array
     */
    private $config = [
        'host' => 'localhost',
        'port' => 8098
    ];

    public $dns;

    private $_data = [];

    public $isNew = TRUE;


    public function __construct($config = []) {
        if (!empty($config)) {
            $this->config = array_merge($this->config, $config);
        }
        $this->riak = $this->getRiakInstance();
        $this->bucket = new Riak\Bucket($this->getBucketName());
    }

    public function __set($name, $value) {
        if (in_array($name, $this->attributes())) {
            $this->_data[$name] = $value;
        }
    }

    public function __get($name) {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }
        return FALSE;
    }

    public function __toString() {
        $data = $this->getData();
        return json_encode($data);
    }

    public function __call($name, $arguments) {
        if (method_exists($this,$name)) {
            return call_user_func([$this, $name], $arguments);
        }
        if (substr($name, 0, 3) == 'set') {
            $attr = strtolower(substr($name, 3));
            $this->$attr = $arguments;
            return $this;
        }
        if (substr($name, 0, 3) == 'get') {
            $attr = strtolower(substr($name, 3));
            return $this->$attr;
        }
    }

    private function getRiakInstance(){
        if (empty($this->riak)) {
            $nodes = (new Riak\Node\Builder())
                    ->atHost($this->config['host'])
                    ->onPort($this->config['port'])
                    ->build();
            $this->riak = new Riak([$nodes]);
        }
        return $this->riak;
    }

    public function getData(){
        $attributes = $this->attributes();
        $data = [];
        foreach ($attributes as $attribute) {
            $data[$attribute] = $this->$attribute;
        }
        return $data;
    }

    public function setData($data = []) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    public function toString(){
        return $this->__toString();
    }

    /**
     * save
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function save() {
        $data = (object) $this->getData();
        $response = (new \Basho\Riak\Command\Builder\StoreObject($this->riak))
            ->inBucket($this->bucket)
            ->buildJsonObject($data)
            ->build()
            ->execute();
        if ($response->getCode() >= 200 && $response->getCode() < 300) {
            $this->isNew = FALSE;
            $this->location = $response->getLocation();
            return $this->key = $this->location->getKey();
        }
        return FALSE;
    }

    public function fetchData(Riak\Command\Object\Response $response, $one = TRUE){
        if (empty($this->location)) {
            $this->location = $response->getLocation();
        }
        $this->key = $this->location->getKey();
        $data = $response->getObject()->getData();
        $this->setData($data);
    }


    /**
     * findOne
     * @param $condition
     * @return RiakModelInterface
     */
    public static function findOne($condition) {
        /*$self = new static();
        $response = (new \Basho\Riak\Command\Builder\FetchObject())
            ->buildLocation('rufus', 'users')
            ->build()
            ->execute();*/
    }

    public function load($key) {
        if (empty($key)) {
            throw new RiakModelException("Invalid key");
        }
        $this->location = new Riak\Location($key, $this->bucket);
        $response = (new \Basho\Riak\Command\Builder\FetchObject($this->riak))
            ->atLocation($this->location)
            ->build()
            ->execute();
        if ($response->isNotFound()) {
            return NULL;
        }
        $this->isNew = FALSE;
        $this->fetchData($response);
        return $this;
    }



    /**
     * delete
     * @return false|int
     * @throws \Exception
     */
    public function delete() {
        if ($this->isNew || empty($this->key)) {
            throw new RiakModelException("Can not delete empty object");
        }
        $response =(new \Basho\Riak\Command\Builder\DeleteObject($this->riak))
            ->atLocation($this->location)
            ->build()
            ->execute();
        return $response->isSuccess();
    }

    /**
     * update
     * @param bool $runValidation
     * @param null $attributeNames
     * @return false|int
     * @throws \Exception
     */
    public function update($runValidation = TRUE, $attributeNames = NULL) {

    }

    /**
     * insert
     * @param bool $runValidation
     * @param null $attributes
     * @return bool
     * @throws \Exception
     */
    public function insert($runValidation = TRUE, $attributes = NULL) {

    }

    public function getKey(){
        return $this->key;
    }

    public function getAttribute($name) {
        $attributes = $this->attributes();
        if (isset($attributes[$name])) {
            return $attributes[$name];
        }
    }

    public function setAttribute($name, $value) {
        die("ok");
    }

    public function getAttributes($names = NULL, $except = []) {
        return $this->attributes();
    }

    public function setAttributes($values, $safeOnly = TRUE) {
        die("OK");
    }

    public function attributes() {
        return [];
    }
}