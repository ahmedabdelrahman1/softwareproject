<?php
session_start();

if (isset($_POST['submit']) && isset($_FILES['myimage'])) {
    include "config.php"; // Assuming you have your database connection in "config.php"

    $tmp_name = $_FILES['myimage']['tmp_name'];
    $error = $_FILES['myimage']['error'];
    $user_id = $_SESSION['user_id']; // Assuming you have the user_id in the session

    if ($error === 0) {
        $img_size = $_FILES['myimage']['size']; // Get the size of the uploaded image
        $img_name = $_FILES['myimage']['name']; // Get the name of the uploaded image

        if ($img_size > 125000) {
            $em = "Sorry, the image is too large.";
            header("location: index.php?error=$em");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Assuming you are using MySQLi
                // $sql = $conn->prepare("INSERT INTO images (img_url, user_id) VALUES (?, ?)");
                // $sql->bind_param("si", $new_img_name, $user_id); // Use "si" for string and integer
                // $res = $sql->execute();
                // $sql->close();

                $sql = $conn->prepare("UPDATE images SET img_url = ? WHERE user_id = ?");
                $sql->bind_param("si", $new_img_name, $user_id); // Use "si" for string and integer
                $res = $sql->execute();
                $sql->close();

                $conn->close();

                if ($res) {
                    header("location: profile.php");
                } else {
                    $em = "Failed to insert into the database.";
                    header("location: courses.php?error=$em");
                }
            } else {
                $em = "Wrong file type. Only JPG, JPEG, and PNG are allowed.";
                header("location: courses.php?error=$em");
            }
        }
    } else {
        $em = "Unknown error!";
        header("location: courses.php?error=$em");
    }
} else {
    header("location: index.php");
}
?>
