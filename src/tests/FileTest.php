<?php
/**
 * Copyright © 2016 by Mobivi.
 * Created by Long Nguyen.
 * User: longnguyen
 * Date: 08/12/2016
 * Time: 10:23
 */

namespace ivoglent\yiiriak\tests;


use ivoglent\yiiriak\tests\models\File;
class FileTest extends \PHPUnit_Framework_TestCase{

    public function testAddNewFile(){
        \Yii::getLogger()->log('Test');
        $file = new  File([
            'dns' => 'http://localhost:8098/riak'
        ]);
        $file->save();
        return $this->assertNotEmpty($file->getKey());
    }
}