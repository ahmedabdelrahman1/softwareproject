<?php
require '../models/classsection.php';
require_once("Models.php");
class course extends Model
{

    private $id;
    private $name;
    private $perview;
    private $instructor;
    private $price;
    private $category;
    private $level;
    private $courseinfo;
    private $startdate;
    private $enddate;
    public static $alerts = [];

    public function __construct($name = "", $password = "", $age = "", $phone = "", $perview = "", $instructor = "", $price = "", $category = "", $level = "", $enddate = "", $startdate = "", $courseinfo = "")
    {
        $this->db = $this->connect();

        $this->name = $name;
        $this->perview = $perview;
        $this->instructor = $instructor;
        $this->price = $price;
        $this->category = $category;
        $this->level = $level;
        $this->enddate = $enddate;
        $this->startdate = $startdate;
        $this->courseinfo = $courseinfo;
    }

    public function insert($name, $instructorID, $preview, $price, $category, $level, $enddate, $startdate, $courseinfo)
    {
        // Format dates before inserting
        $formattedStartDate = date('Y-m-d', strtotime($startdate));
        $formattedEndDate = date('Y-m-d', strtotime($enddate));

        $sql = "INSERT INTO course_table (name, instructorID, preview, price, Category, level, enddate, startdate, courseinfo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sisisssss', $name, $instructorID, $preview, $price, $category, $level, $formattedEndDate, $formattedStartDate, $courseinfo);

        if ($stmt->execute()) {
            course::$alerts[] = "Added!";
        } else {
            course::$alerts[] = "Not added!";
        }

        $stmt->close();
    }



    function select()
    {
        $sql = "SELECT * FROM course_table";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function selectByID($courseID)
    {
        $sql = "SELECT * FROM course_table WHERE ID = :course_id";
        $db = $this->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':course_id', $courseID);
        $stmt->execute();
        $course = $stmt->fetch(PDO::FETCH_ASSOC);
        return $course;
    }



    public function update($courseID, $name, $instructorID, $preview, $price, $category, $level, $enddate, $startdate, $courseinfo)
    {
        $db = $this->connect();
        $formattedStartDate = date('Y-m-d', strtotime($startdate));
        $formattedEndDate = date('Y-m-d', strtotime($enddate));
        // Check if the course with the given ID exists
        $checkQuery = $db->prepare("SELECT * FROM course_table WHERE ID = ?");
        $checkQuery->bind_param('i', $courseID);
        $checkQuery->execute();

        if ($checkQuery->fetch()) {
            // Close the result set of the first query
            $checkQuery->close();

            // Update the course
            $updateQuery = $db->prepare("UPDATE course_table SET name = ?, instructorID = ?, preview = ?, price = ?, Category = ?, level = ?, enddate = ?, startdate = ?, courseinfo = ? WHERE ID = ?");
            $updateQuery->bind_param('sisisssssi', $name, $instructorID, $preview, $price, $category, $level, $formattedEndDate, $formattedStartDate, $courseinfo, $courseID);

            if ($updateQuery->execute()) {
                course::$alerts[] = "Course updated successfully.";
            } else {
                course::$alerts[] = "Failed to update the course.";
            }

            $updateQuery->close();
        } else {
            // Course not found
            course::$alerts[] = "Course not found.";
        }
    }





    function delete($courseID)
    {
        $conn = course::connect();

        // Check if the course exists
        $checkQuery = $conn->prepare("SELECT * FROM course_table WHERE ID = ?");
        $checkQuery->bind_param('i', $courseID);
        $checkQuery->execute();

        // Fetch the result to determine if the course exists
        $checkQuery->store_result();

        if ($checkQuery->num_rows > 0) {
            // Course found, proceed with deletion

            // Reuse the delete function from the section class
            $sections = section::selectByCourse($courseID);

            if (count($sections) > 0) {
                foreach ($sections as $value) {
                    section::delete($value['ID']);
                }
            }

            // Delete the course record from course_table
            $deleteQuery = $conn->prepare("DELETE FROM course_table WHERE ID = ?");
            $deleteQuery->bind_param('i', $courseID);
            $deleteQuery->execute();

            if ($deleteQuery->affected_rows > 0) {
                course::$alerts[] = "Course and related sections deleted successfully.";
            } else {
                course::$alerts[] = "Failed to delete the course.";
            }
        } else {
            // Course not found
            course::$alerts[] = "Course not found.";
        }

        // Close the result set
        $checkQuery->close();
    }



    function selectByInstructorID($instructorID)
    {
        $conn = course::connect();
        $query = "SELECT * FROM course_table WHERE instructorID = :instructor_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':instructor_id', $instructorID, PDO::PARAM_INT);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $courses;
    }


    function selectCoursesByStudentID($studentID)
    {
        $conn = course::connect();
        $query = "SELECT e.ID as enrollmentID, c.* FROM enrollment_table e
                  JOIN course_table c ON e.courseID = c.ID
                  WHERE e.studentID = :student_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':student_id', $studentID, PDO::PARAM_INT);
        $stmt->execute();
        $enrollments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $enrollments;
    }
}
