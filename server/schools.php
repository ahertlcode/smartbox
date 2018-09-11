<?php
/**
This php script implements 

PHP Version 5+
@Author: Abayomi Apetu
*/


require "DbHandlers.php";

class School{

    /** 
Object(class) properties.
     Object(class) public properties.
*/ 
    public $id;
    public $name;
    public $address;
    public $cutoff;
    public $adrule;
    public $dateadded;
    public $status;



    public function _construct(){
        /** Todo, add code for system initialization here!*/ 
    }

    public function save(){
        $db = new DbHandlers();
        $sql = "INSERT INTO schools(";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= 'id';    
        }
        if (isset($this->name) && $this->name!=="" ) {
            $sql.= ',name';    
        }
        if (isset($this->address) && $this->address!=="" ) {
            $sql.= ',address';    
        }
        if (isset($this->cutoff) && $this->cutoff!=="" ) {
            $sql.= ',cutoff';    
        }
        if (isset($this->adrule) && $this->adrule!=="" ) {
            $sql.= ',adrule';    
        }
        if (isset($this->dateadded) && $this->dateadded!=="" ) {
            $sql.= ',dateadded';    
        }
        if (isset($this->status) && $this->status!=="" ) {
            $sql.= ',status';    
        }
        $sql.= ") VALUES (";
        if (isset($this->id) && $this->id!=="") {
            $sql.="'{$this->id}'";    
        }
        if (isset($this->name) && $this->name!=="") {
            $sql.=",'{$this->name}'";    
        }
        if (isset($this->address) && $this->address!=="") {
            $sql.=",'{$this->address}'";    
        }
        if (isset($this->cutoff) && $this->cutoff!=="") {
            $sql.=",'{$this->cutoff}'";    
        }
        if (isset($this->adrule) && $this->adrule!=="") {
            $sql.=",'{$this->adrule}'";    
        }
        if (isset($this->dateadded) && $this->dateadded!=="") {
            $sql.=",'".str_replace(".000Z", "", str_replace("T", " ", $this->dateadded))."'";    
        }
        if (isset($this->status) && $this->status!=="") {
            $sql.=",'{$this->status}'";    
        }
        $sql.=")";
        $sql = str_replace("(,", "(", $sql);
        $savein = $db->executeQuery($sql);
        return $savein;
    }

    public function update($pvcol, $pval){
        $db = new DbHandlers();
        $sql = "UPDATE schools SET ";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= " id = '{$this->id}'";    
        }
        if (isset($this->name) && $this->name!=="" ) {
            $sql.= ", name = '{$this->name}'";    
        }
        if (isset($this->address) && $this->address!=="" ) {
            $sql.= ", address = '{$this->address}'";    
        }
        if (isset($this->cutoff) && $this->cutoff!=="" ) {
            $sql.= ", cutoff = '{$this->cutoff}'";    
        }
        if (isset($this->adrule) && $this->adrule!=="" ) {
            $sql.= ", adrule = '{$this->adrule}'";    
        }
        if (isset($this->dateadded) && $this->dateadded!=="" ) {
            $sql.= ", dateadded = '".str_replace(".000Z", "", str_replace("T", " ", $this->dateadded))."'";    
        }
        if (isset($this->status) && $this->status!=="" ) {
            $sql.= ", status = '{$this->status}'";    
        }
        $sql .=  " WHERE $pvcol = '$pval'";
        $sql = str_replace("SET ,", "SET ", $sql);
        $upd = $db->executeQuery($sql);
        return $upd;
    }

    public function view($critcol=null, $critval=null) {
        $db = new DbHandlers();
        if(is_null($critcol)){
            $sql = "SELECT * from schools order by id DESC";
        } else {
        $sql = "SELECT * from schools WHERE $critcol ='{$critval}'";
        }
        $datasource = $db->getRowAssoc($sql);
        return $datasource;
    }

    public  function delete($critcol, $critval){
        $db = new DbHandlers();
        $sql = "DELETE FROM schools WHERE $critcol ='{$critval}'";
        $d_out = $db->executeQuery($sql);
        return $d_out;
    }
}