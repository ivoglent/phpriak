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
        $file = new  File();
        return $this->assertSame('a','b','We need A');
    }
}