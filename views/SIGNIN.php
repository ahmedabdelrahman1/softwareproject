<?php

@include '../db/config.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('location:index.php');
}

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $passw = md5($_POST['password']);

    $select = " SELECT * FROM user WHERE email = '$email' and password = '$passw' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['type'] = $row['type'];
        if ($row['type'] == 'admin') {

            $_SESSION['admin_name'] = $row['fname'];
            header('location:adminlayout.php');

        } elseif ($row['type'] == 'student') {

            $_SESSION['user_name'] = $row['fname'];
            $_SESSION['last_name'] = $row['lname'];
            header('location:profile.php');

        } elseif ($row['type'] == 'instructor') {

            $_SESSION['user_name'] = $row['fname'];
            header('location:profile.php');

        }
    } else {
        $error = array(); // Initialize $error as an empty array
        $error[] = 'Incorrect email or password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In</title>
    <link rel="icon" type="image/x-icon" href="../public/assets/section.jpg" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/sign.css">
    <script>
        function validateForm() {
            var email = document.forms["signInForm"]["email"].value;
            var password = document.forms["signInForm"]["password"].value;

            if (email === "" || password === "") {
                alert("Email and password must be filled out");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="form-container">
        <form action="" method="post" name="signInForm" onsubmit="return validateForm()">
            <h3>Sign-In</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="err-msg">' . $error . '</span>';
                }
            }
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password" minlength="4">
            <input type="submit" name="submit" value="Submit" class="form-btn">
            <p>Have no account? <a href="SIGNUP.php">Register</a></p>
        </form>
    </div>
</body>
</html>
