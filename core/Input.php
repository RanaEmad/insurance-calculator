<?php
namespace Calculator\Core;
/*
 * To validate and sanitize input fields
 */
class Input {

    protected $field;
    protected $errors;
    protected $result;
    protected $values;
    protected $labels;

    public function __construct() {
        $this->result = true;
        $this->errors = [];
        $this->values=[];
        $this->labels=["carValue"=>"Estimated Car Value","taxPerc"=>"Tax Percentage","installmentsNum"=>"Number Of Installments"];
    }
    /*
     * validates post request fields
     */
    public function post($fields) {
        foreach ($fields as $field => $validation_string) {
            $this->field=$field;
            $value = htmlspecialchars(trim($_POST[$field]));
            $this->values[$field]=$value;
            if ($validation_string) {
                //the validation functions to be implemented as a string
                $validations = explode("|", $validation_string);
                foreach ($validations as $method) {
                    if (strpos($method, "between") === 0) {
                        //function parameters are separated by '_' in the function string
                        $params = explode("_", $method);
                        $this->{$params[0]}($value, $params[1], $params[2]);
                    } else {
                        $this->{$method}($value);
                    }
                }
            }
        }
        $response['result']=  $this->result;
        $response['errors']=  $this->errors;
        $response['values']=  $this->values;
        return $response;
    }

    public function required($value) {
        if (!$value && (int)$value!==0) {
            $this->result = false;
            if (isset($this->errors[$this->field])) {
                $this->errors[$this->field].="<p>The {$this->labels[$this->field]} field is required</p>";
            } else {
                $this->errors[$this->field] = "<p>The {$this->labels[$this->field]} field is required</p>";
            }
        }
    }

    public function numeric($value) {
        if (!is_numeric($value)) {
            $this->result = false;
            if (isset($this->errors[$this->field])) {
                $this->errors[$this->field].="<p>The {$this->labels[$this->field]} field must be numeric</p>";
            } else {
                $this->errors[$this->field] = "<p>The {$this->labels[$this->field]} field must be numeric</p>";
            }
        }
    }

    public function between($value, $min, $max) {
        if (!($value >= $min && $value <= $max)) {
            $this->result = false;
            if (isset($this->errors[$this->field])) {
                $this->errors[$this->field].="<p>The {$this->labels[$this->field]} field must be from $min to $max</p>";
            } else {
                $this->errors[$this->field] = "<p>The $this->field field must be from $min to $max</p>";
            }
        }
    }
    
    public function isInt($value) {
        
        if ((int)$value!=$value) {
            $this->result = false;
            if (isset($this->errors[$this->field])) {
                $this->errors[$this->field].="<p>The {$this->labels[$this->field]} field must be an integer</p>";
            } else {
                $this->errors[$this->field] = "<p>The {$this->labels[$this->field]} field must be an integer</p>";
            }
        }
    }

}
