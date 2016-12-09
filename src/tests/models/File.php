<?php
/**
 * Copyright © 2016 by Orderaw.
 * Created by Long Nguyen.
 * User: longnguyen
 * Date: 08/12/2016
 * Time: 10:31
 */

namespace ivoglent\phpriak\tests\models;


use ivoglent\phpriak\FileModel;

class File extends FileModel{
   
    /**
     * Get attributes array
     * @return array
     */
    public function listAttributes() {
        // TODO: Implement listAttributes() method.
        return [
            'filePath' => 'Path of file'
        ];
    }
}