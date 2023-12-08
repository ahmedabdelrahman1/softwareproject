<?php
include '../db/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $user_id = $_SESSION['user_id'];



    $sql = $conn->prepare("UPDATE user SET fname = ? , lname = ? , email = ? WHERE id = ?");
    $sql->bind_param("sssi", $fname,$lname,$email,$user_id); // Use "si" for string and integer
    $res = $sql->execute();
    $sql->close();
    $conn->close();

                if ($res) {
                    header("location: profile.php");
                } else {
                    $em = "Failed to update the database.";
                    header("location: index.php?error=$em");
                }

    
}else {
    header("location: profile.php");
}
?>
