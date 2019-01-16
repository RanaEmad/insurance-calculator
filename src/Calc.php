<?php

namespace Calculator\Controllers;

use Calculator\Percentage\BasePerc;

class Calc {

    protected $carValue;
    protected $taxPerc;
    protected $installmentsNum;
    
    protected $basePerc;
    protected $comissionPerc;

    public function __construct($carValue,$taxPerc,$installmentsNum) {
        $this->carValue=$carValue;
        $this->taxPerc=$taxPerc/100;
        $this->installmentsNum= $installmentsNum;
        $this->comissionPerc=0.17;
        $this->basePerc= BasePerc::getBasePerc();
    }
    
    public function calcBase() {
        return $this->basePerc * $this->carValue;
    }
    
    public function calcTax() {
        $basePrice = $this->calcBase();
        return $this->taxPerc * $basePrice;
    }

    public function calcComission() {
        $basePrice = $this->calcBase();
        return $this->comissionPerc * $basePrice;
    }

}