<?php
require_once("Models.php");
require_once("classUser.php");
require_once("assignment_class.php");
class Student extends User
{

    private $studentID;
    private $objectassignment;
    public function __construct($id = "")
    {
        $this->db = $this->connect();

        $this->studentID = $id;
    }

    public function submitassigment($studentID, $cm_id, $name, $file, $sectionID, $grade = NULL)
    {
        $this-> objectassignment= new assignment($cm_id,$name,$file,$grade);
        $this->objectassignment->submit($studentID, $sectionID);
    }

    public function showgrade ()
    {
        $this-> objectassignment= new assignment();
         return $this->objectassignment->selectbystudentid($this->studentID);
    }
}
