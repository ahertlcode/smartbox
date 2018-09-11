<?php
/**
This php script implements 

PHP Version 5+
@Author: Abayomi Apetu
*/


require "DbHandlers.php";

class Winner{

    /** 
Object(class) properties.
     Object(class) public properties.
*/ 
    public $id;
    public $username;
    public $award_value;
    public $wdate;
    public $position;



    public function _construct(){
        /** Todo, add code for system initialization here!*/ 
    }

    public function save(){
        $db = new DbHandlers();
        $sql = "INSERT INTO winners(";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= 'id';    
        }
        if (isset($this->username) && $this->username!=="" ) {
            $sql.= ',username';    
        }
        if (isset($this->award_value) && $this->award_value!=="" ) {
            $sql.= ',award_value';    
        }
        if (isset($this->wdate) && $this->wdate!=="" ) {
            $sql.= ',wdate';    
        }
        if (isset($this->position) && $this->position!=="" ) {
            $sql.= ',position';    
        }
        $sql.= ") VALUES (";
        if (isset($this->id) && $this->id!=="") {
            $sql.="'{$this->id}'";    
        }
        if (isset($this->username) && $this->username!=="") {
            $sql.=",'{$this->username}'";    
        }
        if (isset($this->award_value) && $this->award_value!=="") {
            $sql.=",'{$this->award_value}'";    
        }
        if (isset($this->wdate) && $this->wdate!=="") {
            $sql.=",'".str_replace(".000Z", "", str_replace("T", " ", $this->wdate))."'";    
        }
        if (isset($this->position) && $this->position!=="") {
            $sql.=",'{$this->position}'";    
        }
        $sql.=")";
        $sql = str_replace("(,", "(", $sql);
        $savein = $db->executeQuery($sql);
        return $savein;
    }

    public function update($pvcol, $pval){
        $db = new DbHandlers();
        $sql = "UPDATE winners SET ";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= " id = '{$this->id}'";    
        }
        if (isset($this->username) && $this->username!=="" ) {
            $sql.= ", username = '{$this->username}'";    
        }
        if (isset($this->award_value) && $this->award_value!=="" ) {
            $sql.= ", award_value = '{$this->award_value}'";    
        }
        if (isset($this->wdate) && $this->wdate!=="" ) {
            $sql.= ", wdate = '".str_replace(".000Z", "", str_replace("T", " ", $this->wdate))."'";    
        }
        if (isset($this->position) && $this->position!=="" ) {
            $sql.= ", position = '{$this->position}'";    
        }
        $sql .=  " WHERE $pvcol = '$pval'";
        $sql = str_replace("SET ,", "SET ", $sql);
        $upd = $db->executeQuery($sql);
        return $upd;
    }

    public function view($critcol=null, $critval=null) {
        $db = new DbHandlers();
        if(is_null($critcol)){
            $sql = "SELECT * from winners order by id DESC";
        } else {
        $sql = "SELECT * from winners WHERE $critcol ='{$critval}'";
        }
        $datasource = $db->getRowAssoc($sql);
        return $datasource;
    }

    public  function delete($critcol, $critval){
        $db = new DbHandlers();
        $sql = "DELETE FROM winners WHERE $critcol ='{$critval}'";
        $d_out = $db->executeQuery($sql);
        return $d_out;
    }
}