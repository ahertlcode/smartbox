<?php
/**
This php script implements 

PHP Version 5+
@Author: Abayomi Apetu
*/


require "DbHandlers.php";

class Acces{

    /** 
Object(class) properties.
     Object(class) public properties.
*/ 
    public $id;
    public $asset;
    public $access;
    public $dateadded;
    public $addedby;
    public $role;



    public function _construct(){
        /** Todo, add code for system initialization here!*/ 
    }

    public function save(){
        $db = new DbHandlers();
        $sql = "INSERT INTO access(";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= 'id';    
        }
        if (isset($this->asset) && $this->asset!=="" ) {
            $sql.= ',asset';    
        }
        if (isset($this->access) && $this->access!=="" ) {
            $sql.= ',access';    
        }
        if (isset($this->dateadded) && $this->dateadded!=="" ) {
            $sql.= ',dateadded';    
        }
        if (isset($this->addedby) && $this->addedby!=="" ) {
            $sql.= ',addedby';    
        }
        if (isset($this->role) && $this->role!=="" ) {
            $sql.= ',role';    
        }
        $sql.= ") VALUES (";
        if (isset($this->id) && $this->id!=="") {
            $sql.="'{$this->id}'";    
        }
        if (isset($this->asset) && $this->asset!=="") {
            $sql.=",'{$this->asset}'";    
        }
        if (isset($this->access) && $this->access!=="") {
            $sql.=",'{$this->access}'";    
        }
        if (isset($this->dateadded) && $this->dateadded!=="") {
            $sql.=",'".str_replace(".000Z", "", str_replace("T", " ", $this->dateadded))."'";    
        }
        if (isset($this->addedby) && $this->addedby!=="") {
            $sql.=",'{$this->addedby}'";    
        }
        if (isset($this->role) && $this->role!=="") {
            $sql.=",'{$this->role}'";    
        }
        $sql.=")";
        $sql = str_replace("(,", "(", $sql);
        $savein = $db->executeQuery($sql);
        return $savein;
    }

    public function update($pvcol, $pval){
        $db = new DbHandlers();
        $sql = "UPDATE access SET ";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= " id = '{$this->id}'";    
        }
        if (isset($this->asset) && $this->asset!=="" ) {
            $sql.= ", asset = '{$this->asset}'";    
        }
        if (isset($this->access) && $this->access!=="" ) {
            $sql.= ", access = '{$this->access}'";    
        }
        if (isset($this->dateadded) && $this->dateadded!=="" ) {
            $sql.= ", dateadded = '".str_replace(".000Z", "", str_replace("T", " ", $this->dateadded))."'";    
        }
        if (isset($this->addedby) && $this->addedby!=="" ) {
            $sql.= ", addedby = '{$this->addedby}'";    
        }
        if (isset($this->role) && $this->role!=="" ) {
            $sql.= ", role = '{$this->role}'";    
        }
        $sql .=  " WHERE $pvcol = '$pval'";
        $sql = str_replace("SET ,", "SET ", $sql);
        $upd = $db->executeQuery($sql);
        return $upd;
    }

    public function view($critcol=null, $critval=null) {
        $db = new DbHandlers();
        if(is_null($critcol)){
            $sql = "SELECT * from access order by id DESC";
        } else {
        $sql = "SELECT * from access WHERE $critcol ='{$critval}'";
        }
        $datasource = $db->getRowAssoc($sql);
        return $datasource;
    }

    public  function delete($critcol, $critval){
        $db = new DbHandlers();
        $sql = "DELETE FROM access WHERE $critcol ='{$critval}'";
        $d_out = $db->executeQuery($sql);
        return $d_out;
    }
}