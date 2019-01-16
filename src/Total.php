<?php

namespace Calculator\Controllers;

class Total extends Cost {

    public function __construct($carValue, $taxPerc, $installmentsNum) {
        parent::__construct($carValue, $taxPerc, $installmentsNum);
    }

    public function setCost() {
        $this->basePrice = $this->calc->calcBase();
        $this->commision = $this->calc->calcComission();
        $this->tax = $this->calc->calcTax();
    }

}
