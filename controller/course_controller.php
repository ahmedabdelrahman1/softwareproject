


<?php

//include the config and the classes required


include '../db/config.php';
session_start();
require '../models/classcourse.php';


?>

<?php


//creates the course in the data base 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'create':
                $action = $_POST['action'];
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


                $courseObject = new Course($courseName, $instructor, $coursePreview, $price, $category, $level, $courseInfo, $start, $end);

                // Insert data into the 'course' and 'coursedetails' tables
                $courseInsertResult = $courseObject->insert($courseName, $instructor, $coursePreview, $price, $category, $level, $end, $start, $courseInfo, $dynamicRequirements);
                echo 'Create form submitted successfully';
                header("Location:../views/adminlayout.php");

                if ($courseInsertResult && $coursedetailsInsertResult) {
                    // Data successfully inserted into both tables

                } else {
                    echo 'Error submitting Create form';
                }


                break;



                //edites the course in the data basse



            case 'edit':
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

                echo 'Edit form submitted successfully';
                header("Location: ../views/adminlayout.php");

                if ($courseUpdateResult && $coursedetailsUpdateResult) {
                    // Both updates were successful

                } else {
                    // Handle errors if necessary
                    echo 'Edit form submission failed';
                }


                break;


                //deletes the course 


            case 'delete':

                $id = $_POST['course_id'];

                $courseObject = new Course();

                $coursedelet = $courseObject->delete($id);

                // Return a success message or response.
                echo 'success';
                header("Location:../views/adminlayout.php");

                break;
        }
    }
}
?>