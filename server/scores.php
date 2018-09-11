<?php
/**
This php script implements 

PHP Version 5+
@Author: Abayomi Apetu
*/


require "DbHandlers.php";

class Score{

    /** 
Object(class) properties.
     Object(class) public properties.
*/ 
    public $id;
    public $username;
    public $score;
    public $sdate;



    public function _construct(){
        /** Todo, add code for system initialization here!*/ 
    }

    public function save(){
        $db = new DbHandlers();
        $sql = "INSERT INTO scores(";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= 'id';    
        }
        if (isset($this->username) && $this->username!=="" ) {
            $sql.= ',username';    
        }
        if (isset($this->score) && $this->score!=="" ) {
            $sql.= ',score';    
        }
        if (isset($this->sdate) && $this->sdate!=="" ) {
            $sql.= ',sdate';    
        }
        $sql.= ") VALUES (";
        if (isset($this->id) && $this->id!=="") {
            $sql.="'{$this->id}'";    
        }
        if (isset($this->username) && $this->username!=="") {
            $sql.=",'{$this->username}'";    
        }
        if (isset($this->score) && $this->score!=="") {
            $sql.=",'{$this->score}'";    
        }
        if (isset($this->sdate) && $this->sdate!=="") {
            $sql.=",'".str_replace(".000Z", "", str_replace("T", " ", $this->sdate))."'";    
        }
        $sql.=")";
        $sql = str_replace("(,", "(", $sql);
        $savein = $db->executeQuery($sql);
        return $savein;
    }

    public function update($pvcol, $pval){
        $db = new DbHandlers();
        $sql = "UPDATE scores SET ";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= " id = '{$this->id}'";    
        }
        if (isset($this->username) && $this->username!=="" ) {
            $sql.= ", username = '{$this->username}'";    
        }
        if (isset($this->score) && $this->score!=="" ) {
            $sql.= ", score = '{$this->score}'";    
        }
        if (isset($this->sdate) && $this->sdate!=="" ) {
            $sql.= ", sdate = '".str_replace(".000Z", "", str_replace("T", " ", $this->sdate))."'";    
        }
        $sql .=  " WHERE $pvcol = '$pval'";
        $sql = str_replace("SET ,", "SET ", $sql);
        $upd = $db->executeQuery($sql);
        return $upd;
    }

    public function view($critcol=null, $critval=null) {
        $db = new DbHandlers();
        if(is_null($critcol)){
            $sql = "SELECT * from scores order by id DESC";
        } else {
        $sql = "SELECT * from scores WHERE $critcol ='{$critval}'";
        }
        $datasource = $db->getRowAssoc($sql);
        return $datasource;
    }

    public  function delete($critcol, $critval){
        $db = new DbHandlers();
        $sql = "DELETE FROM scores WHERE $critcol ='{$critval}'";
        $d_out = $db->executeQuery($sql);
        return $d_out;
    }
}