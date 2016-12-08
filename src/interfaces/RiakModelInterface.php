<?php
/**
 * Riak Database Model Interface
 * Created by Long Nguyen.
 * Contact: ivoglent@gmail.com
 * Project: YiiRiak
 * Date: 08/12/2016
 * Time: 09:47
 * Version : 1.0.1
 */

namespace ivoglent\yiiriak\interfaces;


interface RiakModelInterface {
    /**
     * Get bucket name
     * @return string
     */
    public function getBucket();

    /**
     * Set bucket name
     * @param string $bucket
     * @return $this
     */
    public function setBucket($bucket);

    /**
     * Get attributes array
     * @return array
     */
    public function listAttributes();
    
}