<?php
namespace Calculator\Controllers;
use Calculator\Core\Input;
use Calculator\Percentage\BasePerc;

class Output {
    protected $input;
    public function __construct() {
        $this->input= new Input();
    }

    public function getOutput() {
        $fields=array(
            "date"=>"required",
            "carValue"=>"required|numeric|between_100_100000",
            "taxPerc"=>"required|numeric|between_0_100",
            "installmentsNum"=>"required|numeric|isInt|between_1_12"
        );
        $validation= $this->input->post($fields);
        $response['result']=true;
        if($validation['result']){
            $values=$validation['values'];
            BasePerc::$date=$values["date"];
            $total = new Total($values["carValue"],$values["taxPerc"],$values["installmentsNum"]);
            $total->setCost();
            $response['total']=$total;
            if($total->installmentsNum>1){
                $installment = new Installment($values["carValue"],$values["taxPerc"],$values["installmentsNum"]);
                $installment->setCost();
                $response['installment']=$installment;
            }
        }
        else{
            $response['result']=false;
            $response['validationErrors']=$validation['errors'];
        }
        return $response;
    }

}
