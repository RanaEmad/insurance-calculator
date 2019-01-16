<?php
namespace Calculator\Percentage;

class BasePerc{
    protected $basePerc;
    public function __construct() {
        $this->basePerc=0.11;
    }
    public static function getBasePerc(){
        if(date("l")=="Friday" && date("H")>=15 && date("H")<=20){
            $this->basePerc=0.13;
        }
        return $this->basePerc;
    }
}

