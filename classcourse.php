<?php
require './classsection.php';
class course {
    public static $alerts=[];
    
    
    public static function connect(){
        $conn=new PDO("mysql:host=localhost;dbname=miu","root","");
        return $conn;
    }
    public static function insert($name,$instructorID,$preview,$price,$detailsID){
        $add=course::connect()->perpare("INSERT INTO course_table() VALUE(?,?,?,?,?)");
        $add->execute(array($name,$instructorID,$preview,$price,$detailsID));
        if($add){
            course::$alerts[]="Added!";
         }
         else{
            course::$alerts[]="Not added!";
         }
    }
    public static function select(){
        $list=course::connect()->prepare("SELECT *FROM course_table");
        $list->execute();
        $fetch=$list->fetchALL(PDO::FETCH_ASSOC);
        return $fetch;
    }

    public static function selectByID($courseID) {
        $conn = course::connect();
        $query = "SELECT * FROM course_table WHERE ID = :course_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':course_id', $courseID, PDO::PARAM_INT);
        $stmt->execute();
        $course = $stmt->fetch(PDO::FETCH_ASSOC);
        return $course;
    }

    public static function delete($courseID) {
        $conn = course::connect();

        // Check if the course exists
        $checkQuery = $conn->prepare("SELECT * FROM course_table WHERE ID = ?");
        $checkQuery->execute(array($courseID));

        if ($checkQuery->rowCount() > 0) {
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
            if ($deleteQuery->execute(array($courseID))) {
                course::$alerts[] = "Course and related sections deleted successfully.";
            } else {
                course::$alerts[] = "Failed to delete the course.";
            }
        } else {
            // Course not found
            course::$alerts[] = "Course not found.";
        }
    }
    public static function selectByInstructorID($instructorID) {
    $conn = course::connect();
    $query = "SELECT * FROM course_table WHERE instructorID = :instructor_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':instructor_id', $instructorID, PDO::PARAM_INT);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $courses;
    }
    public static function selectCoursesByStudentID($studentID) {
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

?>