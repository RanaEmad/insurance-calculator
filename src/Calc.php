<?php

namespace Calculator\Controllers;

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
        $this->comissionPerc=17/100;
        $this->basePerc= $this->getBasePerc()/100;
    }
    
    public function getBasePerc(){
        $basePerc= 11;
        if(date("l")=="Friday" && date("H")>=15 && date("H")<=20){
            $basePerc=13;
        }
        return $basePerc;
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
