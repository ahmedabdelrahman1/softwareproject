<?php
 include 'config.php';
 session_start();
 require './classcourse.php';
 require './classdetails.php';

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        header("Location:adminlayout.php");

    if ($courseInsertResult && $coursedetailsInsertResult) {
        // Data successfully inserted into both tables
      
    } else {
        echo 'Error submitting Create form';
    }


 }

?>