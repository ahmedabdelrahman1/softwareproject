<?php

//include the config and the classes required


 include '../db/config.php';
 session_start();
 require '../models/classCategory.php';


?>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST' ) { 

    
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
   
   switch ($action) {

    //deletes the section and all the content in it 

            case 'delete':
    $id=$_POST['delete_id'];
    
    // Implement the delete function here 
    $objectcategory= new Category();
    $objectcategory->deleteByID($id);
    // Redirect back to the course content page
    header('Location: ../views/adminlayout.php');
    break;
     

// creates the section 

            case 'create':
               
    $Name = $_POST['categoryName'];
    $objectcategory= new Category();
    $objectcategory->addCategory($Name);

    // Redirect back to the page where you added the section
    header('Location: ../views/adminlayout.php');
break;

}
    }
}



?>