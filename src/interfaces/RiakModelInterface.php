<?php
/**
 * Riak Database Model Interface
 * Created by Long Nguyen.
 * Contact: ivoglent@gmail.com
 * @package ivoglent\phpriak
 * @category  none
 * @author  longnguyen
 * @license none
 * @link none
 * @date: 08/12/2016
 * @time: 09:47
 * @version : 1.0.1
 */

namespace ivoglent\phpriak\interfaces;


use Basho\Riak\Bucket;

interface RiakModelInterface {
    /**
     * Get bucket name
     * @return Bucket
     */
    public function getBucketName();

    /**
     * Set bucket name
     * @param string $bucket
     * @return $this
     */
    public function setBucket($bucket);

    /**
     * Get data as array
     * @return array
     */
    public function getData();

    /**
     * setData
     * @param array $data
     * @return $this
     */
    public function setData($data = []);


}