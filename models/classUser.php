<?php
class User {
    public static $alerts=[];
    public static function connect(){
        $conn=new PDO("mysql:host=localhost;dbname=miu","root","");
        return $conn;
    }


    public static function getAllUsers()
    {
        $getAllUsers = User::connect()->prepare("SELECT * FROM user");
        $getAllUsers->execute();
        
    }
    public static function editUser($fname, $lname, $email,$userId) {
       
        $edit = User::connect()->prepare("UPDATE user SET fname = ? , lname = ? , email = ? WHERE id = ?");
        $edit->execute(array($fname,$lname,$email,$userId));

        if ($edit) {
            User::$alerts[] = "Edited!";
            header("location: profile.php");

        } else {
            User::$alerts[] = "Not Edited!";
            $em = "Failed to update the database.";
            header("location: index.php?error=$em");
        }
    }

    public static function deleteUser($userId) {
        try {

        $delete = User::connect()->prepare("DELETE FROM user WHERE id = ?");
        $delete->execute(array($userId));

        $delete_image = User::connect()->prepare("DELETE FROM images WHERE id = ?");
        $delete_image->execute(array($userId));


        if ($delete) {
            User::$alerts[] = "Deleted!";
        } else {
            User::$alerts[] = "Not Deleted!";
        }

        if ($delete_image) {
            User::$alerts[] = "photo Deleted!";
        } else {
            User::$alerts[] = "photo Not Deleted!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    }

    public static function deleteImageByID($userId) {

        try {
        $delete_image = User::connect()->prepare("DELETE FROM images WHERE id = ?");
        $delete_image->execute(array($userId));

        if ($delete_image) {
            User::$alerts[] = "photo Deleted!";
        } else {
            User::$alerts[] = "photo Not Deleted!";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    }

    public static function deleteAllUsers() {
        try {

        $delete_all = User::connect()->prepare("DELETE FROM user");
        $delete_all->execute();

        $delete_image_all = User::connect()->prepare("DELETE FROM images");
        $delete_image_all->execute();

        if ($delete_all) {
            User::$alerts[] = "Deleted!";
        } else {
            User::$alerts[] = "Not Deleted!";
        }

        if ($delete_image_all) {
            User::$alerts[] = "photo Deleted!";
        } else {
            User::$alerts[] = "photo Not Deleted!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    }

    public static function deleteAllimagesById() {
        try {
        $delete_image_all = User::connect()->prepare("DELETE FROM images");
        $delete_image_all->execute();

        if ($delete_image_all) {
            User::$alerts[] = "photo Deleted!";
        } else {
            User::$alerts[] = "photo Not Deleted!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    }

}
?>