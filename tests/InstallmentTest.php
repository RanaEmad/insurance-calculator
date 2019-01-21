<?php

namespace Calculator\Tests;

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

use PHPUnit\Framework\TestCase;
use Calculator\Controllers;
use Calculator\Percentage\BasePerc;

class InstallmentTest extends TestCase {
    public function setUp(){
        BasePerc::$date="2019-01-19 16:00";
    }
    public function tearDown(){
        BasePerc::$date="";
    }
    /**
     * @dataProvider provideInstallment
     */
    public function testInstallment($date,$carValue,$taxPerc,$installmentsNum,$expectedBase,$expectedCommission,$expectedTax,$expectedSum) {
        BasePerc::$date=$date;
        $installment= new Controllers\Installment($carValue, $taxPerc, $installmentsNum);
        $installment->setCost();
        $this->assertEquals($expectedBase, $installment->basePrice, "The expected output is ".  json_encode($expectedBase));
        $this->assertEquals($expectedCommission, $installment->commission, "The expected output is ".  json_encode($expectedCommission));
        $this->assertEquals($expectedTax, $installment->tax, "The expected output is ".  json_encode($expectedTax));
        $this->assertEquals($expectedSum, $installment->sum, "The expected output is ".  json_encode($expectedSum));
    }
    public function provideInstallment(){
        return[
            ["2019-01-19 16:00",10000,10,2,[550.00,550.00],[93.50,93.50],[55.00,55.00],[698.50,698.50]],
            ["2019-01-19 16:00",100.5,50,2,[5.53,5.53],[0.94,0.94],[2.76,2.77],[9.23,9.24]],
            ["2019-01-18 16:00",10000,10,2,[650.00,650.00],[110.50,110.50],[65.00,65.00],[825.50,825.50]],
        ];
    } 

}
