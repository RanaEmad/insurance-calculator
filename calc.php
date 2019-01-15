<?php

class Calc {

    protected $car_value;
    protected $tax_perc;
    protected $installments_num;
    
    protected $base_perc;
    protected $comission_perc;

    public function __construct($car_value,$tax_perc,$installments_num) {
        $this->car_value=$car_value;
        $this->tax_perc=$tax_perc/100;
        $this->installments_num= $installments_num;
        $this->comission_perc=17/100;
        $this->base_perc= $this->get_base_perc()/100;
    }
    
    public function get_base_perc(){
        $base_perc= 11;
        if(date("l")=="Friday" && date("H")>=15 && date("H")<=20){
            $base_perc=13;
        }
        return $base_perc;
    }
    
    public function calc_base() {
        return $this->base_perc * $this->car_value;
    }
    
    public function calc_tax() {
        $base_price = $this->calc_base();
        return $this->tax_perc * $base_price;
    }

    public function calc_comission() {
        $base_price = $this->calc_base();
        return $this->comission_perc * $base_price;
    }

}
