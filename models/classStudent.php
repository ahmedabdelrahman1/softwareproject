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

    public function enroll($studenID,$courseID)
    {
        $sql = "INSERT INTO enrollment_table (studentID, courseID) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('ii', $studenID, $courseID);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function isenrolled($studentID, $courseID)
{
    $sql = "SELECT * FROM enrollment_table WHERE studentID = ? AND courseID = ?";
    $stmt = $this->db->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ii', $studentID, $courseID);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        $stmt->close();

        return ($count > 0); // Returns true if the student is enrolled, false otherwise
    }

    return false; // Return false in case of an error
}
}
