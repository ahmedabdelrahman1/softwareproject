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
                    $courseId = $_POST['courseID'];
                    //$studentObject->delete($StudentId);
                    header('Location: ../views/content.php?courseID=' .  $courseId . '');
                }
                break;


            case "enroll":
                    $studentObject = new Student();
                    if (isset($_POST['StudentID'])) {
                        $StudentId = $_POST['StudentID'];
                        $courseId = $_POST['courseID'];
    
                        // Example: Check if the student is not already enrolled in the course
                        if (!$studentObject->isEnrolled($StudentId, $courseId)) {
                            $enrollmentSuccess = $studentObject->enrollStudent($StudentId, $courseId);
    
                            if ($enrollmentSuccess) {
                                header('Location: payment.php?courseID=' . $courseId . '&studentID=' . $StudentId);
                            } else {
                                echo "Error: Enrollment failed. Please try again later.";
                                exit();
                            }
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
                    $courseId = $_POST['courseID'];


                    if (isset($_FILES['file'])) {
                        $Student_file = $_FILES['file']['name'];
                        $temp_file = $_FILES['file']['tmp_name'];

                        // Check if the file was successfully uploaded
                        if (move_uploaded_file($temp_file, '../assignments/' . $Student_file)) {
                            // File uploaded successfully
                            // You can perform additional logic here if needed

                            print_r($_FILES);
                            $studentObject->submitassigment($studentId, $cm_id, $name, $_FILES, $courseId);


                            // header('Location: ../views/content.php?courseID=' . $courseId);
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
