<?php
/**
 * Riak File Model
 * To help store file into riak database
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

namespace ivoglent\phpriak;


use Basho\Riak\Location;
use ivoglent\phpriak\base\RiakModel;
use ivoglent\phpriak\base\RiakModelException;

abstract class FileModel extends RiakModel
{
    const BUCKET_NAME= 'files';

    protected $file;

    protected $fileInfo = [];

    protected $mimeMaps = [

    ];

    protected $fileData = NULL;
    /**
     * Get bucket name
     * @return string
     */
    public function getBucketName() {
        // TODO: Implement getBucket() method.
        return self::BUCKET_NAME;
    }

    /**
     * Set bucket name
     * @param string $bucket
     * @return $this
     */
    public function setBucket($bucket) {
        // TODO: Implement setBucket() method.
        $this->bucket = $bucket;
    }

    public function addFile($filePath) {
        if (!file_exists($filePath)) {
            throw new RiakModelException("File not found");
        }
        $this->fileInfo = [
            'mime' => mime_content_type($filePath),
            'size' => filesize($filePath),
            'ext' => pathinfo($filePath, PATHINFO_EXTENSION)
        ];

        $this->file = $filePath;
        return $this->fileInfo;
    }
    private function getFileContents(){
        $f = fopen($this->file, 'r');
        $contents = fread($f, filesize($this->file));
        fclose($f);
        return $contents;
    }

    /**
     * save
     * @return bool|string
     * Overide base class to help model store binary file
     *
     */
    public function save() {
        $object = (new \Basho\Riak\Object($this->getFileContents($this->file)))->setContentEncoding("binary")->setContentType($this->fileInfo['mime']);
        $response = (new \Basho\Riak\Command\Builder\StoreObject($this->riak))
            ->inBucket($this->bucket)
            ->withObject($object)
            ->build()
            ->execute();
        if ($response->getCode() >= 200 && $response->getCode() < 300) {
            $this->isNew = FALSE;
            $this->location = $response->getLocation();
            return $this->key = $this->location->getKey();
        }
        return FALSE;
    }

    /**
     * getFile
     * @return mixed
     * return binary content of file
     */
    public function getFile(){
        return $this->fileData;
    }

    /**
     * load
     * @param $key
     * @return $this|null
     * @throws \ivoglent\phpriak\base\RiakModelException
     * Find file by given key
     */
    public function load($key) {
        if (empty($key)) {
            throw new RiakModelException("Invalid key");
        }
        $this->location = new Location($key, $this->bucket);
        $response = (new \Basho\Riak\Command\Builder\FetchObject($this->riak))
            ->atLocation($this->location)
            ->build()
            ->execute();
        if ($response->isNotFound()) {
            return NULL;
        }
        $this->isNew = FALSE;
        $this->key = $key;
        $this->fileData = $response->getObject()->getRawData();
        return $this;
    }
    
}
