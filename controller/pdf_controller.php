<?php

//include the config and the classes required

session_start();
 include '../db/config.php';
 require '../models/classpdf.php';


?>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) { 

    
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
   
   switch ($action) {

    // deletes the pdf using the pdfID 

          case "delete":
            $pdfObject=new pdf();
            if (isset($_POST['pdfID'])) {
                $pdfId = $_POST['pdfID'];
                $sectionId=$_POST['sectionID'];
                $pdfObject->delete($pdfId);
                header('Location: ../views/content.php?sectionID=' .  $sectionId.'');
            }
        break;

        case "create":
            $pdfObject=new pdf();
            if (isset($_POST['buttonupload'])){
                $name=$_POST['name'];
                $sectionId=$_POST['sectionID'];
                if(isset($_FILES['file'])){
                    if ($_FILES['file']['type'] == 'application/pdf') {
                        $pdf_file = $_FILES['file']['name'];
                        move_uploaded_file($_FILES['file']['tmp_name'], 'pdf/'.$pdf_file);
                        //echo "PDF uploaded";
                    } else {
                        echo "Please upload a PDF file.";
                        return false;
                    }
                }
                if(!empty($name)){
                    $pdfObject->insert($name,$pdf_file,$sectionId);
                    header('Location: ../views/content.php?sectionID=' .  $sectionId.'');
                }
                else{
                    pdf::$alerts[]="Fill the fields";
                }
             }
        
        break;
    }
  }
}

?>