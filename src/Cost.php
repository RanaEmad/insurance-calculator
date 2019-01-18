<?php

namespace Calculator\Controllers;

abstract class Cost {

    public $carValue;
    public $installmentsNum;
    public $basePrice;
    public $commission;
    public $tax;
    public $sum;
    protected $calc;

    public function __construct($carValue, $taxPerc, $installmentsNum) {
        $this->carValue = $carValue;
        $this->installmentsNum = $installmentsNum;
        $this->calc = new Calc($carValue, $taxPerc, $installmentsNum);
    }

    abstract public function setCost();

    public function formatValues() {
        $this->carValue= number_format($this->carValue, 2,".","");
        $this->basePrice= number_format($this->basePrice, 2,".","");
        $this->commission= number_format($this->commission, 2,".","");
        $this->tax= number_format($this->tax, 2,".","");
        $this->sum= number_format($this->sum, 2,".","");
    }

}
