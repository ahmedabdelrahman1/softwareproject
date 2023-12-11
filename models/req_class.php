<?php
require_once("Models.php");

class req extends Model
{

    private $id;
    private $req;
    private $req_value;

    public function __construct( $id="",$req = "", $req_value = "")
    {
        $this->db = $this->connect();

        $this->id=$id;
        $this->req = $req;
        $this->req_value = $req_value;
    }

    public function insert_req_value($course_ID, $course_req_ID, $value)
    {
        $sql = "INSERT INTO course_req_value (course_ID, course_req_ID, value) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iis', $course_ID, $course_req_ID, $value);
        $stmt->execute();
        $stmt->close();
    }

    public function insert_req($req)
    {
        $count=0;
        $checkSql = "SELECT COUNT(*) FROM course_req WHERE req = ?";
        $checkStmt = $this->db->prepare($checkSql);
        $checkStmt->bind_param('s', $req);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();
        
        // If the count is 0, the value doesn't exist, so insert it
        if ($count == 0) {
            $insertSql = "INSERT INTO course_req (req) VALUES (?)";
            $insertStmt = $this->db->prepare($insertSql);
            $insertStmt->bind_param('s', $req);
            $insertStmt->execute();
            $insertStmt->close();
        }
    }

    public function deleteRequirement($courseID, $requirementID)
{
    $sql = "DELETE FROM course_req_value WHERE course_ID = ? AND course_req_ID = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param('ii', $courseID, $requirementID);
    $stmt->execute();
    $stmt->close();
}

public function getReqIDByName($name)
{
    $id=0;
    $sql = "SELECT id FROM course_req WHERE req = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $stmt->bind_result($id);

    if ($stmt->fetch()) {
        // Requirement found, return its ID
        $stmt->close();
        return $id;  // Corrected variable name here
    } else {
        // Requirement not found
        $stmt->close();
        return false;
    }
}


   /*public function getRequirementsByCourseID($courseID)
    {
        $sql = "SELECT a.req, ca.value FROM course_req_value ca
            JOIN course_req a ON ca.course_req_ID = a.id
            WHERE ca.course_ID = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $courseID);
        $stmt->execute();

        $result = $stmt->get_result();
        $requirements = array();

        while ($row = $result->fetch_assoc()) {
            $requirements[] = array(
                'req' => $row['req'],
                'value' => $row['value']
            );
        }

        $stmt->close();

        return $requirements;
    }*/

    public function getreq() {
        return $this->req;
    }

    public function getreq_id() {
        return $this->id;
    }

    public function getReqValue()
    {
        return $this->req_value;
    }
}
