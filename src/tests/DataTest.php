<?php
/**
 * Copyright © 2016 by Orderaw.
 * Created by Long Nguyen.
 * User: longnguyen
 * Date: 08/12/2016
 * Time: 13:57
 */

namespace ivoglent\phpriak\tests;


use ivoglent\phpriak\tests\models\Data;

class DataTest extends \PHPUnit_Framework_TestCase{
    public $key;

    public function setUp() {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->key = '';
    }

    public function testCreateData(){
        $data = new Data();
        $data->name = 'Test';
        $data->author = 'Long Nguyen';
        $data->page_number = 12345;
        $data->pub_year = 2016;

        print "\r\n------------------------------------\r\nCreating data object : " . json_encode($data->getData()) . PHP_EOL;
        $data->save();
        $this->key = $data->getKey();
        print "Key : " . $this->key . PHP_EOL;
        $this->assertNotEmpty($this->key);
        return $this->key;
    }
    /**
     * @depends testCreateData
     */
    public function testGetData($key){
        $data = (new Data())->load($key);

        print "\r\n------------------------------------\r\nRetreiving data with " . $key ." : " . $data . PHP_EOL;
        return $this->assertNotEmpty($data);
    }

    /**
     * @depends testCreateData
     */

    public function testUpdateData($key) {
        print "\r\n------------------------------------\r\nUpdating object with key {$key}" . PHP_EOL;
        $data = (new Data())->load($key);
        $data->name = 'Boook here';
        $key = $data->save();
        print $data . PHP_EOL;
        $this->assertNotEmpty($key);
    }

    /**
     * @depends testCreateData
     */
    public function testDeleteData($key) {
        print "\r\n------------------------------------\r\nDeleting object with key {$key} ";
        $data = (new Data())->load($key);
        $result = $data->delete();
        $this->assertTrue($result, 'Delete failed');
    }

}