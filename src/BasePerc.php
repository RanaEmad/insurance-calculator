<?php

namespace Calculator\Percentage;

class BasePerc {
    public static $date;
    public function __construct() {
        
    }

    public static function getBasePerc() {
        $basePerc = 0.11;
        $time=strtotime(self::$date);
        $day=date("l",$time);
        $hour=date("H",$time);
        if ($day == "Friday" && $hour >= 15 && $hour <= 20) {
            $basePerc = 0.13;
        }
        return $basePerc;
    }

}
