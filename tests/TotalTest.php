<?php

namespace Calculator\Tests;

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

use PHPUnit\Framework\TestCase;
use Calculator\Controllers;
use Calculator\Percentage\BasePerc;

class TotalTest extends TestCase {
    public function setUp(){
        BasePerc::$date="2019-01-19 16:00";
    }
    public function tearDown(){
        BasePerc::$date="";
    }
    /**
     * @dataProvider provideTotal
     */
    public function testTotal($date,$carValue,$taxPerc,$installmentsNum,$expectedBase,$expectedCommission,$expectedTax,$expectedSum) {
        BasePerc::$date=$date;
        $total= new Controllers\Total($carValue, $taxPerc, $installmentsNum);
        $total->setCost();
        $this->assertEquals($expectedBase, $total->basePrice, "The expected output is $expectedBase");
        $this->assertEquals($expectedCommission, $total->commission, "The expected output is $expectedCommission");
        $this->assertEquals($expectedTax, $total->tax, "The expected output is $expectedTax");
        $this->assertEquals($expectedSum, $total->sum, "The expected output is $expectedSum");
    }
    public function provideTotal(){
        return[
            ["2019-01-19 16:00",10000,10,2,1100.00,187.00,110.00,1397.00],
            ["2019-01-19 16:00",100.5,50,2,11.06,1.88,5.53,18.47],
            ["2019-01-18 16:00",10000,10,2,1300.00,221.00,130.00,1651.00]
        ];
    } 

}
