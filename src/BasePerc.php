<?php

namespace Calculator\Percentage;

class BasePerc {

    public function __construct() {
        
    }

    public static function getBasePerc() {
        $basePerc = 0.11;
        if (date("l") == "Friday" && date("H") >= 15 && date("H") <= 20) {
            $basePerc = 0.13;
        }
        return $basePerc;
    }

}
