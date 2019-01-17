<?php
namespace Calculator\Controllers;

abstract class Cost{
    public $installmentsNum;
    public $basePrice;
    public $commission;
    public $tax;
    protected $calc;
    public function __construct($carValue,$taxPerc,$installmentsNum) {
        $this->installmentsNum=$installmentsNum;
        $this->calc= new Calc($carValue,$taxPerc,$installmentsNum);
    }
    abstract public function setCost();
}
