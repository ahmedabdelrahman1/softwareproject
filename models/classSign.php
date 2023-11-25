<?php
class Sign {
    public static $alerts=[];
    public static function connect(){
        $conn=new PDO("mysql:host=localhost;dbname=miu","root","");
        return $conn;
    }


    public static function sign_up($fname, $lname, $email, $passw, $type,$imgUrl, $userId) {
        $add = Sign::connect()->prepare("INSERT INTO user(fname, lname, email, password, type) VALUES('$fname','$lname','$email','$passw','$type')");
        $add->execute(array($fname, $lname, $email, $passw, $type));

        $sql = Sign::connect()->prepare("INSERT INTO images (img_url, user_id) VALUES ('$imgUrl', '$userId')");
        $sql->execute(array($imgUrl, $userId));

        if ($add) {
            Sign::$alerts[] = "Added!";
        } else {
            Sign::$alerts[] = "Not added!";
        }

        if ($sql) {
            Sign::$alerts[] = "photo Added!";
        } else {
            Sign::$alerts[] = "photo Not added!";
        }
    }

    public static function sign_out(){

    session_start();
    session_unset();
    session_destroy();
    header('location:index.php');

    exit;
    }


}
?>