<?php
@include '../db/config.php';

if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $passw = md5($_POST['password']);
    $cpassw = md5($_POST['cpassword']);
    $type = $_POST['type'];
    $new_img_name = ' ';
    $select = " SELECT * FROM user WHERE email = '$email' && password = '$passw' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        if ($passw != $cpassw) {
            $error[] = 'Passwords do not match!';
        } else {
            $insert = "INSERT INTO user(fname, lname, email, password, type) VALUES('$fname','$lname','$email','$passw','$type')";
            mysqli_query($conn, $insert);

            $user_id = mysqli_insert_id($conn);

            $sql = $conn->prepare("INSERT INTO images (img_url, user_id) VALUES (?, ?)");
            $sql->bind_param("si", $new_img_name, $user_id);
            $res = $sql->execute();
            $sql->close();

            header('location: SIGNIN.php');
        }
    }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="icon" type="image/x-icon" href="static/assets/section.jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/sign.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm() {
            var password = document.forms["registrationForm"]["password"].value;
            var confirmPassword = document.forms["registrationForm"]["cpassword"].value;

            if (password != confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }

            if (!isStrongPassword(password)) {
                alert("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one digit.");
                return false;
            }

            return true;
        }

        function isStrongPassword(password) {
            // Add your password strength validation logic here
            var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
            return regex.test(password);
        }
    </script>
</head>

<body>
    <div class="form-container">
        <form action="" method="post" name="registrationForm" onsubmit="return validateForm()">
            <h3>Registration</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="err-msg">' . $error . '</span>';
                }
            }
            ?>
            <input type="text" name="fname" required placeholder="First name">
            <input type="text" name="lname" required placeholder="Last name">
            <input type="email" name="email" required placeholder="E-mail">
            <input type="password" name="password" required placeholder="Password" minlength="8">
            <input type="password" name="cpassword" required placeholder="Confirm your password" minlength="8">
            <select name="type">
                <option value="student">Student</option>
                <option value="instructor">Instructor</option>
            </select>
            <input type="submit" name="submit" value="Register" class="form-btn">
            <p>Already have an account? <a href="SIGNIN.php">Sign-In</a></p>
        </form>
    </div>
</body>

</html>
