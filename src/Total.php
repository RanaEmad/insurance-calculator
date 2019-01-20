<?php

namespace Calculator\Controllers;

class Total extends Cost {

    public function __construct($carValue, $taxPerc, $installmentsNum) {
        parent::__construct($carValue, $taxPerc, $installmentsNum);
    }

    public function setCost() {
        $this->basePrice = round($this->calc->calcBase(),2);
        $this->commission = round($this->calc->calcCommission(),2);
        $this->tax = round($this->calc->calcTax(),2);
        $this->sum=  $this->basePrice+$this->commission+$this->tax;
        $this->formatValues();
    }

}
