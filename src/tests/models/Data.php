<?php
/**
 * Copyright © 2016 by Mobivi.
 * Created by Long Nguyen.
 * User: longnguyen
 * Date: 08/12/2016
 * Time: 13:58
 */

namespace ivoglent\phpriak\tests\models;


use Basho\Riak\Bucket;
use ivoglent\phpriak\DataModel;
use ivoglent\phpriak\interfaces\RiakModelInterface;

/**
 * ivoglent\phpriak\tests\models
 * Class Data
 * @package ivoglent\phpriak\tests\models
 * @category  none
 * @author  longnguyen
 * @license none
 * @link none
 * @property string $name
 * @property string $author
 * @property integer $page_number
 * @property string $pub_year
 */
class Data extends DataModel
{
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

    public function attributes() {
        return array_keys([
            'name' => 'Name',
            'author' => 'Author',
            'page_number' => 'Number of pages',
            'pub_year' => 'Publish year'
        ]);
    }
}