<?php

//include the config and the classes required


include '../db/config.php';
session_start();
require '../models/pageclass.php';
require '../models/usertypesclass.php';

?>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {



            case 'permission':
                $choosenPages = $_POST['choosen-pages']; // Array of selected pages
                $userType = $_POST['UserType']; // Selected user type
                $objectusertype= new usertype();
                // Now you can process the data as needed
                // For example, you can loop through the selected pages
                foreach ($choosenPages as $pageID) {
                    // Process each selected page ID
                    echo "Selected Page ID: $pageID<br>";
                    $objectusertype->insert($userType,$pageID);
                }
            
                // Process the selected user type
                echo "Selected User Type: $userType";
                header("Location:../views/adminlayout.php");
        }
    }
}



?>