<?php

namespace Calculator\Controllers;

class Installment extends Cost {

    public function __construct($carValue, $taxPerc, $installmentsNum) {
        parent::__construct($carValue, $taxPerc, $installmentsNum);
    }

    public function setCost() {
        $this->basePrice = $this->calc->calcBase() / $this->installmentsNum;
        $this->commision = $this->calc->calcComission() / $this->installmentsNum;
        $this->tax = $this->calc->calcTax() / $this->installmentsNum;
    }

}
