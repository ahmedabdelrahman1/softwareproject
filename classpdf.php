<?php
class pdf {

    public static $alerts=[];
    public static function connect ()
    {
        $conn=new PDO("mysql:host=localhost;dbname=miu","root","");
        return $conn;
    }
    public static function insert($name, $pdf_file, $sectionID)
    {
    $add = pdf::connect()->prepare("INSERT INTO pdf_table(name, pdf_file, sectionID) VALUES(?, ?, ?)");
    $add->execute(array($name, $pdf_file, $sectionID));
    if ($add) {
      
        header("Location: content.php?&sectionID=$sectionID");

    } else {
       
        pdf::$alerts[] = "Not added!";
        
    }
    }
    public static function selectBySectionID($sectionID){
        $conn = pdf::connect();
        $query = $conn->prepare("SELECT * FROM pdf_table WHERE sectionID = ?");
        $query->execute(array($sectionID));
        $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;
    }
    public static function delete($pdfID) {
        $conn = pdf::connect();
        $query = $conn->prepare("SELECT pdf_file, sectionID FROM pdf_table WHERE ID = ?");
        $query->execute(array($pdfID));
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            $pdfFile = $result['pdf_file'];
            $sectionID = $result['sectionID'];
    
            // Delete the PDF record from the database
            $deleteQuery = $conn->prepare("DELETE FROM pdf_table WHERE ID = ?");
            $deleteQuery->execute(array($pdfID));
    
            // Delete the actual PDF file from the server
            if (unlink("pdf/" . $pdfFile)) {
                header("Location: content.php?sectionID=$sectionID");
            } else {
                // Handle file deletion error
                pdf::$alerts[] = "Failed to delete the PDF file.";
            }
        } else {
            // Handle PDF record not found
            pdf::$alerts[] = "PDF record not found.";
        }
    }
    
}

?>