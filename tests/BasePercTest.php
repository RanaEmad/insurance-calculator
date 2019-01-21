<?php

namespace Calculator\Tests;

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

use PHPUnit\Framework\TestCase;
use Calculator\Percentage\BasePerc;

class BasePercTest extends TestCase {
    
    /**
     * @dataProvider provideBasePerc
     */
    public function testBasePerc($date,$expected) {
        BasePerc::$date=$date;
        $basePerc=  BasePerc::getBasePerc();
        $this->assertEquals($expected, $basePerc, "The expected output is $expected");
    }
    public function provideBasePerc(){
        return[
            ["2019-01-11 16:00",0.13],
            ["2019-01-18 20:00",0.13],
            ["2019-01-18 12:00",0.11],
            ["2019-01-19 16:00",0.11]
        ];
    } 

}
