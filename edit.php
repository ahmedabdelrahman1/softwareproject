<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $details = $_POST['details'];
    $instructor = $_POST['instructor'];
    $price = $_POST['price'];
    $section = $_POST['section'];

    $sql = "UPDATE course_table SET name='$name', details='$details', instructorID='$instructor', price='$price', sectionID='$section' WHERE ID='$id'";

    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }

    $conn->close();
}
?>
