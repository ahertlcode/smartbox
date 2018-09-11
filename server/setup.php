<?php
/**
This php script implements 

PHP Version 5+
@Author: Abayomi Apetu
*/


require "DbHandlers.php";

class Setup{

    /** 
Object(class) properties.
     Object(class) public properties.
*/ 
    public $id;
    public $quiz_time;
    public $number_of_questions;
    public $min_win_score;
    public $mode;



    public function _construct(){
        /** Todo, add code for system initialization here!*/ 
    }

    public function save(){
        $db = new DbHandlers();
        $sql = "INSERT INTO setup(";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= 'id';    
        }
        if (isset($this->quiz_time) && $this->quiz_time!=="" ) {
            $sql.= ',quiz_time';    
        }
        if (isset($this->number_of_questions) && $this->number_of_questions!=="" ) {
            $sql.= ',number_of_questions';    
        }
        if (isset($this->min_win_score) && $this->min_win_score!=="" ) {
            $sql.= ',min_win_score';    
        }
        if (isset($this->mode) && $this->mode!=="" ) {
            $sql.= ',mode';    
        }
        $sql.= ") VALUES (";
        if (isset($this->id) && $this->id!=="") {
            $sql.="'{$this->id}'";    
        }
        if (isset($this->quiz_time) && $this->quiz_time!=="") {
            $sql.=",'{$this->quiz_time}'";    
        }
        if (isset($this->number_of_questions) && $this->number_of_questions!=="") {
            $sql.=",'{$this->number_of_questions}'";    
        }
        if (isset($this->min_win_score) && $this->min_win_score!=="") {
            $sql.=",'{$this->min_win_score}'";    
        }
        if (isset($this->mode) && $this->mode!=="") {
            $sql.=",'{$this->mode}'";    
        }
        $sql.=")";
        $sql = str_replace("(,", "(", $sql);
        $savein = $db->executeQuery($sql);
        return $savein;
    }

    public function update($pvcol, $pval){
        $db = new DbHandlers();
        $sql = "UPDATE setup SET ";
        if (isset($this->id) && $this->id!=="" ) {
             $sql.= " id = '{$this->id}'";    
        }
        if (isset($this->quiz_time) && $this->quiz_time!=="" ) {
            $sql.= ", quiz_time = '{$this->quiz_time}'";    
        }
        if (isset($this->number_of_questions) && $this->number_of_questions!=="" ) {
            $sql.= ", number_of_questions = '{$this->number_of_questions}'";    
        }
        if (isset($this->min_win_score) && $this->min_win_score!=="" ) {
            $sql.= ", min_win_score = '{$this->min_win_score}'";    
        }
        if (isset($this->mode) && $this->mode!=="" ) {
            $sql.= ", mode = '{$this->mode}'";    
        }
        $sql .=  " WHERE $pvcol = '$pval'";
        $sql = str_replace("SET ,", "SET ", $sql);
        $upd = $db->executeQuery($sql);
        return $upd;
    }

    public function view($critcol=null, $critval=null) {
        $db = new DbHandlers();
        if(is_null($critcol)){
            $sql = "SELECT * from setup order by id DESC";
        } else {
        $sql = "SELECT * from setup WHERE $critcol ='{$critval}'";
        }
        $datasource = $db->getRowAssoc($sql);
        return $datasource;
    }

    public  function delete($critcol, $critval){
        $db = new DbHandlers();
        $sql = "DELETE FROM setup WHERE $critcol ='{$critval}'";
        $d_out = $db->executeQuery($sql);
        return $d_out;
    }
}