<?php

require_once __DIR__.DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
include_once 'config/const.php';

use Calculator\Controllers\Output;

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $output= new Output();
    echo json_encode($output->getOutput());
}
else{
    include_once BASE_URL.'/views/calculator_form.php';
}