<?php

@include 'config.php';

if(isset($_POST['submit'])){

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $passw = md5($_POST['password']);
    $cpassw = md5($_POST['cpassword']);
    $type = $_POST['type'];

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$passw' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $error[] = 'user already exist!';

    }else{

        if($passw != $cpassw){
            $error[] = 'password not matched!';
        }else{
            $insert = "INSERT INTO user(fname, lname, email, password, type) VALUES('$fname','$lname','$email','$passw','$type')";
            mysqli_query($conn, $insert);
            header('location:SIGNIN.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="static/css/sign.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
        <h3>Registeration </h3>
        <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="err-msg">'.$error.'</span>';
                }
            }
        ?>
        <input type="text" name="fname" required placeholder="First name">
        <input type="text" name="lname" required placeholder="Last name">
        <input type="email" name="email" required placeholder="E-mail">
        <input type="password" name="password" required placeholder="Password" minlength="4">
        <input type="password" name="cpassword" required placeholder="Confirm your password" minlength="4">
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