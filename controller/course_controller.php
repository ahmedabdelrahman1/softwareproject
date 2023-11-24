


<?php

//include the config and the classes required


 include '../views/config.php';
 session_start();
 require '../models/classcourse.php';
 require '../models/classdetails.php';


?>

<?php


//creates the course in the data base 


 if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['action'])) {
        $action = $_POST['action'];
   
        switch ($action) {
            case 'create':

    $courseName = $_POST['createName'];
    $coursePreview = $_POST['createpreview'];
    $instructor = $_POST['createInstructor'];
    $price = $_POST['createPrice'];
    $detailsID = $_POST['createdetailsID'];
    $category = $_POST['createCategory'];
    $level = $_POST['createLevel'];
    $duration = $_POST['createDuration'];
    $courseInfo = $_POST['createCourseInfo'];

    // Insert data into the 'course' and 'coursedetails' tables
    $courseInsertResult = course::insert($courseName,$instructor ,$coursePreview , $price, $detailsID);
    $coursedetailsInsertResult = coursedetails::insert($category, $level, $duration, $courseInfo);
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
    $name = $_POST['editName'];
    $coursePreview = $_POST['editpreview'];
    $instructor = $_POST['editInstructor'];
    $price = $_POST['editPrice'];
    $detailsID = $_POST['editdetailsID'];
    $category = $_POST['editCategory'];
    $level = $_POST['editLevel'];
    $duration = $_POST['editDuration'];
    $courseInfo = $_POST['editCourseInfo'];

    // Update data in the 'course' table
    $courseUpdateResult = course::update($id, $name, $instructor, $coursePreview, $price, $detailsID);

    // Update data in the 'coursedetails' table
    $coursedetailsUpdateResult = coursedetails::updateByID($detailsID, $category, $level, $duration, $courseInfo);
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


if (isset($_POST['course_id'])) {
    $courseId = $_POST['course_id'];
    $course=course::selectByID($courseId);

    coursedetails::deleteByID($course['detailsID']);
    

    // Call the `delete` function from the classcourse.php file.
    course::delete($courseId);

    // Return a success message or response.
    echo 'success';
    header("Location:../views/adminlayout.php");
} 

break;
}

    }
 }
?>