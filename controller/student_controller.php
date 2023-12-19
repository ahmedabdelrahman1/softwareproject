<?php

//include the config and the classes required

session_start();
include '../db/config.php';
require '../models/classStudent.php';


?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {

                // deletes the Student using the StudentID 

            case "removesubmission":
                $studentObject = new Student();
                if (isset($_POST['StudentID'])) {
                    $StudentId = $_POST['StudentID'];
                    $sectionId = $_POST['sectionID'];
                    //$studentObject->delete($StudentId);
                    header('Location: ../views/content.php?sectionID=' .  $sectionId . '');
                }
                break;

                case "enroll":
                    $studentObject = new Student();
                    if (isset($_POST['studentID'])) {
                        $StudentId = $_POST['studentID'];
                        $courseId = $_POST['courseID'];
                        echo$StudentId;
                        echo$courseId;
    
                        // Example: Check if the student is not already enrolled in the course
                        if (!$studentObject->isenrolled($StudentId, $courseId)) {
                            $enrollmentSuccess = $studentObject->enroll($StudentId, $courseId);
    
                            
                                header('Location: ../views/mycourses.php');
                           
                        } else {
                            echo "Error: Student is already enrolled in the course.";
                            exit();                        }
                    }
                    break;


            case "submit":

                $studentObject = new Student();

                if (isset($_POST['buttonupload'])) {
                    $name = $_POST['name'];
                    $studentId = $_POST['studentID'];
                    $cm_id = $_POST['cm_id'];
                    $sectionId = $_POST['sectionID'];


                    if (isset($_FILES['file'])) {
                        $Student_file = $_FILES['file']['name'];
                        $temp_file = $_FILES['file']['tmp_name'];

                        // Check if the file was successfully uploaded
                        if (move_uploaded_file($temp_file, '../assignments/' . $Student_file)) {
                            // File uploaded successfully
                            // You can perform additional logic here if needed

                            print_r($_FILES);
                            $studentObject->submitassigment($studentId, $cm_id, $name, $_FILES, $sectionId);


                            // header('Location: ../views/content.php?sectionID=' . $sectionId);
                            //  exit(); // Make sure to exit after a header redirect
                        } else {
                            User::$alerts[] = "Fill the fields";
                        }
                    } else {
                        // Failed to upload the file
                        User::$alerts[] = "Failed to upload the file.";
                    }
                } else {
                    // No file selected
                    User::$alerts[] = "Please select a file.";
                }

                break;
        }
    }
}


?>