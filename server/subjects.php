<?php
/**
This php script implements 

PHP Version 5+
@Author: Abayomi Apetu
*/


require "DbHandlers.php";

class Subject{

    /** 
Object(class) properties.
     Object(class) public properties.
*/ 
    public $id;
    public $subject;
    public $moderator;
    public $dateadded;
    public $active;



    public function _construct(){
        /** Todo, add code for system initialization here!*/ 
    }

    public function save(){
        $db = new DbHandlers();
        $sql = "INSERT INTO subjects(";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= 'id';    
        }
        if (isset($this->subject) && $this->subject!=="" ) {
            $sql.= ',subject';    
        }
        if (isset($this->moderator) && $this->moderator!=="" ) {
            $sql.= ',moderator';    
        }
        if (isset($this->dateadded) && $this->dateadded!=="" ) {
            $sql.= ',dateadded';    
        }
        if (isset($this->active) && $this->active!=="" ) {
            $sql.= ',active';    
        }
        $sql.= ") VALUES (";
        if (isset($this->id) && $this->id!=="") {
            $sql.="'{$this->id}'";    
        }
        if (isset($this->subject) && $this->subject!=="") {
            $sql.=",'{$this->subject}'";    
        }
        if (isset($this->moderator) && $this->moderator!=="") {
            $sql.=",'{$this->moderator}'";    
        }
        if (isset($this->dateadded) && $this->dateadded!=="") {
            $sql.=",'".str_replace(".000Z", "", str_replace("T", " ", $this->dateadded))."'";    
        }
        if (isset($this->active) && $this->active!=="") {
            $sql.=",'{$this->active}'";    
        }
        $sql.=")";
        $sql = str_replace("(,", "(", $sql);
        $savein = $db->executeQuery($sql);
        return $savein;
    }

    public function update($pvcol, $pval){
        $db = new DbHandlers();
        $sql = "UPDATE subjects SET ";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= " id = '{$this->id}'";    
        }
        if (isset($this->subject) && $this->subject!=="" ) {
            $sql.= ", subject = '{$this->subject}'";    
        }
        if (isset($this->moderator) && $this->moderator!=="" ) {
            $sql.= ", moderator = '{$this->moderator}'";    
        }
        if (isset($this->dateadded) && $this->dateadded!=="" ) {
            $sql.= ", dateadded = '".str_replace(".000Z", "", str_replace("T", " ", $this->dateadded))."'";    
        }
        if (isset($this->active) && $this->active!=="" ) {
            $sql.= ", active = '{$this->active}'";    
        }
        $sql .=  " WHERE $pvcol = '$pval'";
        $sql = str_replace("SET ,", "SET ", $sql);
        $upd = $db->executeQuery($sql);
        return $upd;
    }

    public function view($critcol=null, $critval=null) {
        $db = new DbHandlers();
        if(is_null($critcol)){
            $sql = "SELECT * from subjects order by id DESC";
        } else {
        $sql = "SELECT * from subjects WHERE $critcol ='{$critval}'";
        }
        $datasource = $db->getRowAssoc($sql);
        return $datasource;
    }

    public  function delete($critcol, $critval){
        $db = new DbHandlers();
        $sql = "DELETE FROM subjects WHERE $critcol ='{$critval}'";
        $d_out = $db->executeQuery($sql);
        return $d_out;
    }
}