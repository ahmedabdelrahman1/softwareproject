


<?php

// Include the configuration and required class files
include '../db/config.php';
session_start();
require '../models/classcourse.php';



?>

<?php


//creates the course in the data base 


// Check if the form is submitted using POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if the 'action' parameter is set in the POST data
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $courseObject = new Course();

        // Switch statement to handle different actions
        switch ($action) {
            case 'create':
                // Handling course creation action
                $courseName = $_POST['createName'];
                $coursePreview = $_POST['createpreview'];
                $instructor = $_POST['createInstructor'];
                $price = $_POST['createPrice'];
                $category = $_POST['createCategory'];
                $level = $_POST['createLevel'];
                $start = $_POST['start'];
                $end = $_POST['end'];
                $courseInfo = $_POST['createCourseInfo'];

                // Create a new Course object
                $courseObject = new Course($courseName, $instructor, $coursePreview, $price, $category, $level, $courseInfo, $start, $end);

                // Insert data into the 'course' table
                $courseInsertResult = $courseObject->insert($courseName, $instructor, $coursePreview, $price, $category, $level, $end, $start, $courseInfo);

                // Check if course creation was successful
                if ($courseInsertResult) {
                    // Enroll the student in the created course
                    $enrollResult = $courseObject->enrollStudent($_SESSION['user_id'], $courseObject->getId());

                    // Check if enrollment was successful
                    if ($enrollResult) {
                        // Redirect to the payment page or any other page
                        header("Location:../views/payment.php");
                        exit();
                    } else {
                        echo 'Failed to enroll in the course.';
                        // Handle enrollment failure
                    }
                } else {
                    echo 'Error submitting Create form';
                    // Handle course creation failure
                }

                // Redirect to admin layout page
                header("Location:../views/adminlayout.php");
                break;

            case 'edit':
                // Handling course editing action
                $id = $_POST['course_id'];
                $courseName = $_POST['editName'];
                $coursePreview = $_POST['editpreview'];
                $instructor = $_POST['editInstructor'];
                $price = $_POST['editPrice'];
                $category = $_POST['editCategory'];
                $level = $_POST['editLevel'];
                $start = $_POST['editstart'];
                $end = $_POST['editend'];
                $courseInfo = $_POST['editCourseInfo'];

                // Create a new Course object
                $courseObject = new Course($courseName, $instructor, $coursePreview, $price, $category, $level, $courseInfo, $start, $end);

                // Update data in the 'course' table
                $courseUpdateResult = $courseObject->update($id, $courseName, $instructor, $coursePreview, $price, $category, $level, $end, $start, $courseInfo);

                // Check if course editing was successful
                if ($courseUpdateResult) {
                    echo 'Edit form submitted successfully';
                } else {
                    // Handle update failure
                    echo 'Edit form submission failed';
                }

                // Redirect to admin layout page
                header("Location: ../views/adminlayout.php");
                break;

            case 'delete':
                // Handling course deletion action
                $id = $_POST['course_id'];
                $courseObject = new Course();
                $courseDeleteResult = $courseObject->delete($id);

                // Check if course deletion was successful
                if ($courseDeleteResult) {
                    echo 'Course deleted successfully';
                } else {
                    // Handle deletion failure
                    echo 'Failed to delete the course.';
                }

                // Redirect to admin layout page
                header("Location:../views/adminlayout.php");
                break;

            // Add more cases if needed for other actions

            default:
                // Handle unexpected actions
                echo 'Invalid action';
                break;
        }
    }
}

?>
