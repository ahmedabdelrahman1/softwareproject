<?php
 include 'config.php';
 session_start();
 require './classcourse.php';
 require './classdetails.php';



 if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
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
        header("Location: adminlayout.php");

    if ($courseUpdateResult && $coursedetailsUpdateResult) {
        // Both updates were successful
        
    } else {
        // Handle errors if necessary
        echo 'Edit form submission failed';
    }
}


?>