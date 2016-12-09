<?php
/**
 * Riak data model
 * Document is stored type
 * With structure based on key-value pair
 * Created by Long Nguyen.
 * Contact: ivoglent@gmail.com
 * Project: phpriak
 * Date: 08/12/2016
 * Time: 09:47
 * Version : 1.0.1
 */

namespace ivoglent\phpriak;


use ivoglent\phpriak\base\RiakModel;

abstract class DataModel extends RiakModel{
    const BUCKET_NAME = 'data';
    /**
     * Get bucket name
     * @return Bucket
     */
    public function getBucketName() {
        return self::BUCKET_NAME;
    }

    /**
     * Set bucket name
     * @param string $bucket
     * @return $this
     */
    public function setBucket($bucket) {
        $this->bucket = $bucket;
    }
}