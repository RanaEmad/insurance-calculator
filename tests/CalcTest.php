<?php

namespace Calculator\Tests;

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

use PHPUnit\Framework\TestCase;
use Calculator\Controllers;
use Calculator\Percentage\BasePerc;

class CalcTest extends TestCase {
    public function setUp(){
        BasePerc::$date="2019-01-19 16:00";
    }
    public function tearDown(){
        BasePerc::$date="";
    }

    /**
     * @dataProvider provideCalcBase
     */
    public function testCalcBase($date,$carValue,$taxPerc,$installmentsNum,$expected) {
        BasePerc::$date=$date;
        $calc= new Controllers\Calc($carValue, $taxPerc, $installmentsNum);
        $output=$calc->calcBase();
        $this->assertEquals($expected, $output, "The expected output is $expected");
    }
    public function provideCalcBase(){
        return[
            ["2019-01-19 16:00",10000,10,2,1100.00],
            ["2019-01-19 16:00",50000.5,10,2,5500.055],
            ["2019-01-19 16:00",283.125,10,2,31.14375],
            ["2019-01-18 16:00",10000,10,2,1300.00]

        ];
    }
    /**
     * @dataProvider provideCalcTax
     */
    public function testCalcTax($date,$carValue,$taxPerc,$installmentsNum,$expected) {
        BasePerc::$date=$date;
        $calc= new Controllers\Calc($carValue, $taxPerc, $installmentsNum);
        $output=$calc->calcTax();
        $this->assertEquals($expected, $output, "The expected output is $expected");
    }
    public function provideCalcTax(){
        return[
            ["2019-01-19 16:00",10000,10,2,110.00],
            ["2019-01-19 16:00",50000.5,5,2,275.00275000000005],
            ["2019-01-19 16:00",283.125,90.6,2,28.2162375],
            ["2019-01-18 16:00",10000,10,2,130.00]
        ];
    }
    /**
     * @dataProvider provideCalcCommission
     */
    public function testCalcCommission($date,$carValue,$taxPerc,$installmentsNum,$expected) {
        BasePerc::$date=$date;
        $calc= new Controllers\Calc($carValue, $taxPerc, $installmentsNum);
        $output=$calc->calcCommission();
        $this->assertEquals($expected, $output, "The expected output is $expected");
    }
    public function provideCalcCommission(){
        return[
            ["2019-01-19 16:00",10000,10,2,187.00],
            ["2019-01-19 16:00",50000.5,10,2,935.00935],
            ["2019-01-19 16:00",283.125,10,2,5.2944375],
            ["2019-01-18 16:00",10000,10,2,221.00000000000003]
        ];
    }
    

}
