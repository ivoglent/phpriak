<?php
/**
 * Copyright © 2016 by Mobivi.
 * Created by Long Nguyen.
 * User: longnguyen
 * Date: 08/12/2016
 * Time: 13:57
 */

namespace ivoglent\phpriak\tests;


use ivoglent\phpriak\tests\models\Data;

class DataTest extends \PHPUnit_Framework_TestCase{
    private $key;
    public function testCreateData(){
        $data = new Data();
        $data->name = 'Test';
        $data->author = 'Long Nguyen';
        $data->page_number = 12345;
        $data->pub_year = 2016;

        print "Creating data object : " . json_encode($data->getData()) . PHP_EOL;
        $data->save();
        $this->key = $data->getKey();
        return $this->assertNotEmpty($this->key);
    }

    public function testGetData(){
        $data = Data::findOne($this->key);
    }
}