<?php
require_once("Models.php");
require_once("classUser.php");
require_once("assignment_class.php");
class Instructor extends User {

    private $instructorID;

    public function __construct($id = "")
    {
        $this->db = $this->connect();

        $this->instructorID = $id;
    }

    public function gradeassignments ($assignment_id,$grade)
    {
           $objectassignment=new assignment();

           $objectassignment->grade($assignment_id,$grade);
    }
}
?>