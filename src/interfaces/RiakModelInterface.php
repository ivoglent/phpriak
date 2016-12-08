<?php
/**
 * Riak Database Model Interface
 * Created by Long Nguyen.
 * Contact: ivoglent@gmail.com
 * Project: phpriak
 * Date: 08/12/2016
 * Time: 09:47
 * Version : 1.0.1
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


}