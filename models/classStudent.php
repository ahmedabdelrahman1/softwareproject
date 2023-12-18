<?php
require_once("Models.php");
require_once("classUser.php");
require_once("assignment_class.php");
class Student extends User
{

    private $studentID;

    public function __construct($id = "")
    {
        $this->db = $this->connect();

        $this->studentID = $id;
    }

    public function submitassigment($studentID, $cm_id, $name, $file, $sectionID, $grade = NULL)
    {
        $objectassignment = new assignment($cm_id,$name,$file,$grade);
        $objectassignment->submit($studentID, $sectionID);
    }
}
