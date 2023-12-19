<?php

//include the config and the classes required


 include '../db/config.php';
 session_start();
 require '../models/classsection.php';


?>

<?php

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
}




if ($_SERVER['REQUEST_METHOD'] === 'POST' ) { 

    
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
   
   switch ($action) {

    //deletes the section and all the content in it 

            case 'delete':
    $section_id_to_delete = $_POST['delete_section'];
    
    // Implement the delete function here
    section::delete($section_id_to_delete);

    // Redirect back to the course content page
    header('Location: ../views/coursecontent.php?course_id=' .  $course_id.'');
    break;
     

// creates the section 

            case 'create':
               
    $sectionName = $_POST['sectionName'];
    $sectionDetails = $_POST['sectionDetails'];
    
    section::insert($sectionName,  $course_id, $sectionDetails);

    // Redirect back to the page where you added the section
    header('Location: ../views/coursecontent.php?course_id=' .  $course_id.'');
break;

}
    }
}



?>