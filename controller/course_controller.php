


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
                $dynamicRequirements = array();

                // Loop through the POST data and identify dynamic requirements based on the field names
                foreach ($_POST as $key => $value) {
                    // Check if the field is a dynamic requirement
                    if (strpos($key, 'newRequirementName') === 0) {
                        // Extract the count from the field name
                        $count = substr($key, strlen('newRequirementName'));

                        // Use the count to get the corresponding value
                        $requirementName = $_POST['newRequirementName' . $count];
                        $requirementValue = $_POST['newRequirementValue' . $count];

                        // Add the dynamic requirement to the array
                        $dynamicRequirements[] = array(
                            'name' => $requirementName,
                            'value' => $requirementValue
                        );
                    }
                }


                // Create a new Course object
                $courseObject = new Course($courseName, $instructor, $coursePreview, $price, $category, $level, $courseInfo, $start, $end);

                // Insert data into the 'course' and 'coursedetails' tables
                $courseInsertResult = $courseObject->insert($courseName, $instructor, $coursePreview, $price, $category, $level, $end, $start, $courseInfo, $dynamicRequirements);
                echo 'Create form submitted successfully';
                header("Location:../views/adminlayout.php");

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
                $requirementID = isset($_POST['selectedRequirements']) ? $_POST['selectedRequirements'] : [];
                $courseInfo = $_POST['createCourseInfo'];
                $dynamicRequirements = array();

                // Loop through the POST data and identify dynamic requirements based on the field names
                foreach ($_POST as $key => $value) {
                    // Check if the field is a dynamic requirement
                    if (strpos($key, 'newRequirementName') === 0) {
                        // Extract the count from the field name
                        $count = substr($key, strlen('newRequirementName'));

                        // Use the count to get the corresponding value
                        $requirementName = $_POST['newRequirementName' . $count];
                        $requirementValue = $_POST['newRequirementValue' . $count];

                        // Add the dynamic requirement to the array
                        $dynamicRequirements[] = array(
                            'name' => $requirementName,
                            'value' => $requirementValue
                        );
                    }
                }
                $courseObject = new Course($courseName, $instructor, $coursePreview, $price, $category, $level, $courseInfo, $start, $end);

                // Update data in the 'course' table
                $reqobject = new req();
                $req_delet = $reqobject->deleteRequirement($id, $requirementID);
                $courseUpdateResult = $courseObject->update($id, $courseName, $instructor, $coursePreview, $price, $category, $level, $end, $start, $courseInfo,$dynamicRequirements);

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

                $coursedelet = $courseObject->delete($id);

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
