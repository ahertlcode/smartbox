<?php
/**
This php script implements 

PHP Version 5+
@Author: Abayomi Apetu
*/


require "DbHandlers.php";

class Question_bank{

    /** 
Object(class) properties.
     Object(class) public properties.
*/ 
    public $id;
    public $question;
    public $answer;
    public $status;
    public $exam_id;
    public $school_id;



    public function _construct(){
        /** Todo, add code for system initialization here!*/ 
    }

    public function save(){
        $db = new DbHandlers();
        $sql = "INSERT INTO question_banks(";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= 'id';    
        }
        if (isset($this->question) && $this->question!=="" ) {
            $sql.= ',question';    
        }
        if (isset($this->answer) && $this->answer!=="" ) {
            $sql.= ',answer';    
        }
        if (isset($this->status) && $this->status!=="" ) {
            $sql.= ',status';    
        }
        if (isset($this->exam_id) && $this->exam_id!=="" ) {
            $sql.= ',exam_id';    
        }
        if (isset($this->school_id) && $this->school_id!=="" ) {
            $sql.= ',school_id';    
        }
        $sql.= ") VALUES (";
        if (isset($this->id) && $this->id!=="") {
            $sql.="'{$this->id}'";    
        }
        if (isset($this->question) && $this->question!=="") {
            $sql.=",'{$this->question}'";    
        }
        if (isset($this->answer) && $this->answer!=="") {
            $sql.=",'{$this->answer}'";    
        }
        if (isset($this->status) && $this->status!=="") {
            $sql.=",'{$this->status}'";    
        }
        if (isset($this->exam_id) && $this->exam_id!=="") {
            $sql.=",'{$this->exam_id}'";    
        }
        if (isset($this->school_id) && $this->school_id!=="") {
            $sql.=",'{$this->school_id}'";    
        }
        $sql.=")";
        $sql = str_replace("(,", "(", $sql);
        $savein = $db->executeQuery($sql);
        return $savein;
    }

    public function update($pvcol, $pval){
        $db = new DbHandlers();
        $sql = "UPDATE question_banks SET ";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= " id = '{$this->id}'";    
        }
        if (isset($this->question) && $this->question!=="" ) {
            $sql.= ", question = '{$this->question}'";    
        }
        if (isset($this->answer) && $this->answer!=="" ) {
            $sql.= ", answer = '{$this->answer}'";    
        }
        if (isset($this->status) && $this->status!=="" ) {
            $sql.= ", status = '{$this->status}'";    
        }
        if (isset($this->exam_id) && $this->exam_id!=="" ) {
            $sql.= ", exam_id = '{$this->exam_id}'";    
        }
        if (isset($this->school_id) && $this->school_id!=="" ) {
            $sql.= ", school_id = '{$this->school_id}'";    
        }
        $sql .=  " WHERE $pvcol = '$pval'";
        $sql = str_replace("SET ,", "SET ", $sql);
        $upd = $db->executeQuery($sql);
        return $upd;
    }

    public function view($critcol=null, $critval=null) {
        $db = new DbHandlers();
        if(is_null($critcol)){
            $sql = "SELECT * from question_banks order by id DESC";
        } else {
        $sql = "SELECT * from question_banks WHERE $critcol ='{$critval}'";
        }
        $datasource = $db->getRowAssoc($sql);
        return $datasource;
    }

    public  function delete($critcol, $critval){
        $db = new DbHandlers();
        $sql = "DELETE FROM question_banks WHERE $critcol ='{$critval}'";
        $d_out = $db->executeQuery($sql);
        return $d_out;
    }
}