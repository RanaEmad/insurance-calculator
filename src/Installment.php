<?php

namespace Calculator\Controllers;

class Installment extends Cost {

    public function __construct($carValue, $taxPerc, $installmentsNum) {
        parent::__construct($carValue, $taxPerc, $installmentsNum);
    }

    public function setCost() {
        $this->basePrice = $this->roundExtra($this->calc->calcBase());
        $this->commission = $this->roundExtra($this->calc->calcCommission());
        $this->tax = $this->roundExtra($this->calc->calcTax());
        $this->setSum();
    }

    public function roundExtra($total) {
        $amount = 0;
        $divider = $this->installmentsNum;
        $roundedAmounts = [];
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
