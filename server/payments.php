<?php
/**
This php script implements 

PHP Version 5+
@Author: Abayomi Apetu
*/


require "DbHandlers.php";

class Payment{

    /** 
Object(class) properties.
     Object(class) public properties.
*/ 
    public $id;
    public $username;
    public $pay_ref;
    public $pay_date;
    public $used;



    public function _construct(){
        /** Todo, add code for system initialization here!*/ 
    }

    public function save(){
        $db = new DbHandlers();
        $sql = "INSERT INTO payments(";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= 'id';    
        }
        if (isset($this->username) && $this->username!=="" ) {
            $sql.= ',username';    
        }
        if (isset($this->pay_ref) && $this->pay_ref!=="" ) {
            $sql.= ',pay_ref';    
        }
        if (isset($this->pay_date) && $this->pay_date!=="" ) {
            $sql.= ',pay_date';    
        }
        if (isset($this->used) && $this->used!=="" ) {
            $sql.= ',used';    
        }
        $sql.= ") VALUES (";
        if (isset($this->id) && $this->id!=="") {
            $sql.="'{$this->id}'";    
        }
        if (isset($this->username) && $this->username!=="") {
            $sql.=",'{$this->username}'";    
        }
        if (isset($this->pay_ref) && $this->pay_ref!=="") {
            $sql.=",'{$this->pay_ref}'";    
        }
        if (isset($this->pay_date) && $this->pay_date!=="") {
            $sql.=",'".str_replace(".000Z", "", str_replace("T", " ", $this->pay_date))."'";    
        }
        if (isset($this->used) && $this->used!=="") {
            $sql.=",'{$this->used}'";    
        }
        $sql.=")";
        $sql = str_replace("(,", "(", $sql);
        $savein = $db->executeQuery($sql);
        return $savein;
    }

    public function update($pvcol, $pval){
        $db = new DbHandlers();
        $sql = "UPDATE payments SET ";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= " id = '{$this->id}'";    
        }
        if (isset($this->username) && $this->username!=="" ) {
            $sql.= ", username = '{$this->username}'";    
        }
        if (isset($this->pay_ref) && $this->pay_ref!=="" ) {
            $sql.= ", pay_ref = '{$this->pay_ref}'";    
        }
        if (isset($this->pay_date) && $this->pay_date!=="" ) {
            $sql.= ", pay_date = '".str_replace(".000Z", "", str_replace("T", " ", $this->pay_date))."'";    
        }
        if (isset($this->used) && $this->used!=="" ) {
            $sql.= ", used = '{$this->used}'";    
        }
        $sql .=  " WHERE $pvcol = '$pval'";
        $sql = str_replace("SET ,", "SET ", $sql);
        $upd = $db->executeQuery($sql);
        return $upd;
    }

    public function view($critcol=null, $critval=null) {
        $db = new DbHandlers();
        if(is_null($critcol)){
            $sql = "SELECT * from payments order by id DESC";
        } else {
        $sql = "SELECT * from payments WHERE $critcol ='{$critval}'";
        }
        $datasource = $db->getRowAssoc($sql);
        return $datasource;
    }

    public  function delete($critcol, $critval){
        $db = new DbHandlers();
        $sql = "DELETE FROM payments WHERE $critcol ='{$critval}'";
        $d_out = $db->executeQuery($sql);
        return $d_out;
    }
}