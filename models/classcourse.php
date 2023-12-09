<?php
require_once '../models/classsection.php';
require_once 'Models.php';

class Course extends Model
{
    private $id;
    private $name;
    private $preview;
    private $instructor;
    private $price;
    private $category;
    private $level;
    private $courseinfo;
    private $startdate;
    private $enddate;
    private $courses;

    public static $alerts = [];

    public function __construct($id = "", $name = "", $preview = "", $instructor = "", $price = "", $category = "", $level = "", $enddate = "", $startdate = "", $courseinfo = "")
    {
        parent::__construct(); // Connect to the database

        $this->id = $id;
        $this->name = $name;
        $this->preview = $preview;
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
            self::$alerts[] = "Added!";
            // Enroll the student in the created course
            $enrollResult = $this->enrollStudent($_SESSION['user_id'], $this->getId());

            if ($enrollResult) {
                // Redirect to the payment page or any other page
                header("Location:../views/payment.php");
                exit();
            } else {
                echo 'Failed to enroll in the course.';
                // Handle enrollment failure
            }
        } else {
            self::$alerts[] = "Not added!";
            echo 'Error submitting Create form';
            // Handle course creation failure
        }

        $stmt->close();
    }

    // Enrollment logic: Check if the student is already enrolled in the course
    public function enrollStudent($studentID, $courseID)
    {
        $enrollmentCheckQuery = $this->db->prepare("SELECT * FROM enrollment_table WHERE studentID = ? AND courseID = ?");
        $enrollmentCheckQuery->bind_param('ii', $studentID, $courseID);
        $enrollmentCheckQuery->execute();

        if ($enrollmentCheckQuery->fetch()) {
            // Student is already enrolled
            self::$alerts[] = "Already enrolled in the course.";
            return false;
        } else {
            // Enroll the student
            $enrollmentInsertQuery = $this->db->prepare("INSERT INTO enrollment_table (studentID, courseID) VALUES (?, ?)");
            $enrollmentInsertQuery->bind_param('ii', $studentID, $courseID);

            if ($enrollmentInsertQuery->execute()) {
                self::$alerts[] = "Enrolled successfully.";
                return true;
            } else {
                self::$alerts[] = "Failed to enroll in the course.";
                return false;
            }
        }
    }

    public function fetchCourses()
    {
        $this->courses = array();
        $this->db = $this->connect();
        $result = $this->readCourses(); // Assuming you have a readCourses method

        while ($row = $result->fetch_assoc()) {
            // Print out the fetched row


            // Adjust the class instantiation based on your User class structure
            array_push(
                $this->courses,
                new Course(
                    $row["ID"],
                    $row["name"],
                    $row["preview"],
                    $row["instructorID"],
                    $row["price"],
                    $row["Category"],
                    $row["level"],
                    $row["enddate"],
                    $row["startdate"],
                    $row["courseinfo"]
                )
            );
        }
    }


    private function readCourses()
    {
        $sql = "SELECT * FROM course_table"; // Replace with your actual table name
        $result = $this->db->query($sql);
        return $result;
    }

    function selectByID($courseID)
    {
        $sql = "SELECT * FROM course_table WHERE ID = ?";
        $db = $this->connect();
        $stmt = $db->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param('i', $courseID);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result) {
                $courseData = $result->fetch_assoc();
                
                if ($courseData) {
                    // Instantiate a Course object with the fetched data
                    $course = new Course(
                        $courseData["ID"],
                        $courseData["name"],
                        $courseData["preview"],
                        $courseData["instructorID"],
                        $courseData["price"],
                        $courseData["Category"],
                        $courseData["level"],
                        $courseData["enddate"],
                        $courseData["startdate"],
                        $courseData["courseinfo"]
                    );
                    
                    return $course;
                } else {
                    // Handle error if necessary
                    return false;
                }
            } else {
                // Handle error if necessary
                return false;
            }
        } else {
            // Handle error if necessary
            return false;
        }
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


    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPerview($perview)
    {
        $this->perview = $perview;
    }

    public function setInstructor($instructor)
    {
        $this->instructor = $instructor;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function setCourseinfo($courseinfo)
    {
        $this->courseinfo = $courseinfo;
    }

    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;
    }

    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;
    }

    // Getter methods
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPerview()
    {
        return $this->perview;
    }

    public function getInstructor()
    {
        return $this->instructor;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getCourseinfo()
    {
        return $this->courseinfo;
    }

    public function getStartdate()
    {
        return $this->startdate;
    }

    public function getEnddate()
    {
        return $this->enddate;
    }

    public function getCourses()
    {
        return $this->courses;
    }
}


  

    // Other existing methods...
}
?>
