<?php

use PHPUnit_Framework_TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase {

    public function __construct()
    {
        $this->testPath = __DIR__;
        $this->storage = $this->testPath.'/storage/';
    }

}