<?php

namespace Calculator\Controllers;
/*
 * each installment calculation
 */
class Installment extends Cost {

    public function __construct($carValue, $taxPerc, $installmentsNum) {
        parent::__construct($carValue, $taxPerc, $installmentsNum);
    }

    public function setCost() {
        $this->basePrice = $this->roundExtra(round($this->calc->calcBase(),2));
        $this->commission = $this->roundExtra(round($this->calc->calcCommission(),2));
        $this->tax = $this->roundExtra(round($this->calc->calcTax(),2));
        $this->setSum();
    }
    /*
     * To make sure the sum of all attributes equals the total
     */
    public function roundExtra($total) {
        $amount = 0;
        $divider = $this->installmentsNum;
        $roundedAmounts = [];
        //in case sums do not divide equally to divide the remainder
        while ($divider > 0) {
            $amount = number_format(round($total / $divider, 2), 2,".","");
            $roundedAmounts[] = $amount;
            $total -=$amount;
            $divider--;
        }
        sort($roundedAmounts);
        return $roundedAmounts;
    }
    
    public function setSum(){
        $this->sum=[];
        for($i=0;$i<$this->installmentsNum;$i++){
            $this->sum[$i]=  number_format($this->basePrice[$i]+$this->commission[$i]+$this->tax[$i], 2,".","");
        }
    }

}
