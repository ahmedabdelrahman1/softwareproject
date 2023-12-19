<?php

//include the config and the classes required

session_start();
include '../db/config.php';
require '../models/classInstructor.php';


?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    if (isset($_POST['action'])) {
        $action = $_POST['action'];
       print_r($_POST);

        switch ($action) {
            
                
            case "addgrade":
                $InstructorObject = new Instructor();
                
                if (isset($_POST['assignmentId'])) {
                    $assignmentId = $_POST['assignmentId'];
                    $grade = $_POST['grade'];
                    $file = unserialize(urldecode($_POST['file']));
                     
                    $InstructorObject->gradeassignments( $assignmentId,$grade);
                    header('Location: ../views/submissionpage.php?title=' .   urlencode(serialize($file)) . '');
                }
                break;
            }
        }
        
    }
?>