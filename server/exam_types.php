<?php
/**
This php script implements 

PHP Version 5+
@Author: Abayomi Apetu
*/


require "DbHandlers.php";

class Exam_type{

    /** 
Object(class) properties.
     Object(class) public properties.
*/ 
    public $id;
    public $name;
    public $logo;
    public $dateadded;
    public $active;



    public function _construct(){
        /** Todo, add code for system initialization here!*/ 
    }

    public function save(){
        $db = new DbHandlers();
        $sql = "INSERT INTO exam_types(";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= 'id';    
        }
        if (isset($this->name) && $this->name!=="" ) {
            $sql.= ',name';    
        }
        if (isset($this->logo) && $this->logo!=="" ) {
            $sql.= ',logo';    
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
        if (isset($this->name) && $this->name!=="") {
            $sql.=",'{$this->name}'";    
        }
        if (isset($this->logo) && $this->logo!=="") {
            $sql.=",'{$this->logo}'";    
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
        $sql = "UPDATE exam_types SET ";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= " id = '{$this->id}'";    
        }
        if (isset($this->name) && $this->name!=="" ) {
            $sql.= ", name = '{$this->name}'";    
        }
        if (isset($this->logo) && $this->logo!=="" ) {
            $sql.= ", logo = '{$this->logo}'";    
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
            $sql = "SELECT * from exam_types order by id DESC";
        } else {
        $sql = "SELECT * from exam_types WHERE $critcol ='{$critval}'";
        }
        $datasource = $db->getRowAssoc($sql);
        return $datasource;
    }

    public  function delete($critcol, $critval){
        $db = new DbHandlers();
        $sql = "DELETE FROM exam_types WHERE $critcol ='{$critval}'";
        $d_out = $db->executeQuery($sql);
        return $d_out;
    }
}