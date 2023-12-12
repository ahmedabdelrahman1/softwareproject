<?php

//include the config and the classes required

session_start();
 include '../db/config.php';
 require '../models/classcourse_matrial.php';


?>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) { 

    
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
   
   switch ($action) {

    // deletes the course_matrial using the course_matrialID 

          case "delete":
            $course_matrialObject=new course_matrial();
            if (isset($_POST['course_matrialID'])) {
                $course_matrialId = $_POST['course_matrialID'];
                $sectionId=$_POST['sectionID'];
                $course_matrialObject->delete($course_matrialId);
                header('Location: ../views/content.php?sectionID=' .  $sectionId.'');
            }
        break;

        case "create":
            
            $course_matrialObject = new course_matrial();
            
            if (isset($_POST['buttonupload'])) {
                $name = $_POST['name'];
                $sectionId = $_POST['sectionID'];
            
                if (isset($_FILES['file'])) {
                    $course_matrial_file = $_FILES['file']['name'];
                    $temp_file = $_FILES['file']['tmp_name'];
            
                    // Check if the file was successfully uploaded
                    if (move_uploaded_file($temp_file, '../files/' . $course_matrial_file)) {
                        // File uploaded successfully
                        // You can perform additional logic here if needed
            
                        if (!empty($name)) {
                            print_r($_FILES);
                            $course_matrialObject->insert($name, $_FILES, $sectionId);
                            echo "ttttttt";
                            print_r(course_matrial::$alerts) ;
                            
                          //  header('Location: ../views/content.php?sectionID=' . $sectionId);
                          //  exit(); // Make sure to exit after a header redirect
                        } else {
                            course_matrial::$alerts[] = "Fill the fields";
                        }
                    } else {
                        // Failed to upload the file
                        course_matrial::$alerts[] = "Failed to upload the file.";
                    }
                } else {
                    // No file selected
                    course_matrial::$alerts[] = "Please select a file.";
                }
            }
           
            
        
        break;
    }
  }
}

?>