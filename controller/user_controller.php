


<?php

//include the config and the classes required


 include '../views/config.php';
 session_start();
 require '../models/classSign.php';



?>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['submit'])) {
        $action = $_POST['submit'];
   
        switch ($action) {
            case 'sign_up':
                $fname = mysqli_real_escape_string($conn, $_POST['fname']);
                $lname = mysqli_real_escape_string($conn, $_POST['lname']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $passw = md5($_POST['password']);
                $cpassw = md5($_POST['cpassword']);
                $type = $_POST['type'];
                $new_img_name = ' ';
                $user_id = mysqli_insert_id($conn);
               $select = " SELECT * FROM user WHERE email = '$email' && password = '$passw' ";
            
                $result = mysqli_query($conn, $select);
            
                if(mysqli_num_rows($result) > 0){
            
                    $error[] = 'user already exist!';
            
                }else{
            
                    if($passw != $cpassw){
                        $error[] = 'password not matched!';
                    }else{
                        Sign::sign_up($fname, $lname, $email, $passw, $type,$new_img_name, $userId);
                        
            
                        header('location:SIGNIN.php');
                    }
                }


 break;



    case 'sign_in':
    
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
                    header('location:courses.php');
        
                }
            } else {
                $error[] = 'incorrect email or password!';
            }
        
        }


break;


//deletes the course 


    case 'sign_out':

        Sign::sign_out();
        header('location:index.php');

break;
            }

        }
    }

?>