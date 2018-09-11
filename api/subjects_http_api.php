<?php
/**
This php script implements 

PHP Version 5+
@Author: Abayomi Apetu
*/


header("Access-Control-Allow-Origin: *");
header("Content-Type: text/json");
ini_set("memory_limit", "1024M");

require "../server/renderer.php";
require "../server/subjects.php";


//retrieve API params/data from calling service.
if(isset($_POST) && !empty($_POST))
    $data = (object)$_POST;
else
    $data = json_decode(file_get_contents("php://input"));

if(isset($data)){
    //strip the trailing 's' character from the table name to created the model reference name.
    if($data->table[strlen($data->table)-1] == "s"){
        $obj = substr($data->table, 0, strlen($data->table)-1);
    } else {
        $obj = $data->table;
}

//capitalize the first character of the class name.
$objc = ucwords($obj);

//create an instance of the model.
$$obj = new $objc();

//extract key from data using key value pair.
if (isset($data->data) && !empty($data->data)) {
    $dobc = (object)$data->data;
    foreach($dobc as $ky => $v) {
        $$obj->$ky = $dobc->$ky;
    }
}

//save the data to to model.
if($data->method == "save") {
    $sout = $$obj->save();
    if ($sout == 1)
        $sout = array("status"=>"success", "msg"=>"{$objc} saved successfully.");
    else
        $sout = array("status"=>"fail", "msg"=>"{$objc} could not be saved.");
}

//update the model with supplied dataset.
if($data->method == "update") {
    if (isset($data->data->col_name) && isset($data->data->col_value)){
        $sout = $$obj->update($data->data->col_name, $data->data->col_value);
        if($sout == 1)
            $sout = array("status"=>"success", "msg"=>"{$objc} updated successfully.");
        else
            $sout = array("status"=>"failed", "msg"=>"There is an error, {$objc} could not be updated.");
    } else {
        $sout = array("status"=>"warning", "msg"=>"To update you must specific a criteria.");
    }
}
//retrieve records from the model.
if($data->method == "view") {
    if (isset($data->data->col_name) && isset($data->data->col_value))
        $sout = $$obj->view($data->data->col_name, $data->data->col_value);
    else
        $sout = $$obj->view();
}
//delete record from model.
if($data->method == "delete") {
    if (isset($data->data->col_name) && isset($data->data->col_value)){
        $sout = $$obj->delete($data->data->col_name, $data->data->col_value);
        if($sout == 1)
            $sout = array("status"=>"success", "msg"=>"{$objc} deleted successfully.");
        else
            $sout = array("status"=>"failed", "msg"=>"There is an error, {$objc} could not be deleted.");
    } else {
        $sout = array("status"=>"warning", "msg"=>"To delete you must specific a criteria.");
    }
}

//send out put to the stand output.
$rnd = new renderer();
echo $rnd->render("json", $sout, "{$obj}, <list></list>");
}
