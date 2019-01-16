<?php
namespace Calculator\Controllers;
use Calculator\Core\Input;

class Output {
    protected $input;
    public function __construct() {
        $this->input= new Input();
    }

    public function getOutput() {
        $fields=array(
            "carValue"=>"required|numeric|between_100_100000",
            "taxPerc"=>"required|numeric|between_0_100",
            "installmentsNum"=>"required|numeric|between_1_12"
        );
        $validation= $this->input->post($fields);
        $response['result']=true;
        if($validation['result']){
            $values=$validation['values'];
            $total = new Total($values["carValue"],$values["taxPerc"],$values["installmentsNum"]);
            $total->setCost();
            $installment = new Installment($values["carValue"],$values["taxPerc"],$values["installmentsNum"]);
            $installment->setCost();
            $response['total']=$total;
            $response['installment']=$installment;
        }
        else{
            $response['result']=false;
            $response['validation_errors']=$validation['errors'];
        }
        return $response;
    }

}
