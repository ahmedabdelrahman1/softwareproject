<?php
class section {
    public static $alerts=[];
    public static function connect(){
        $conn=new PDO("mysql:host=localhost;dbname=miu","root","");
        return $conn;
    }
    public static function insert($name, $courseID, $detials) {
        $add = section::connect()->prepare("INSERT INTO section_table (name, courseID, detials) VALUES (?, ?, ?)");
        $add->execute(array($name, $courseID, $detials));
        if ($add) {
            section::$alerts[] = "Added!";
        } else {
            section::$alerts[] = "Not added!";
        }
    }
    
    
    public static function selectByCourse($courseID) {
        $conn = section::connect();
        $query = "SELECT * FROM section_table WHERE courseID = ?";
        $list = $conn->prepare($query);
        $list->execute(array($courseID));
        $fetch = $list->fetchAll(PDO::FETCH_ASSOC);
        return $fetch;
    }
    

    public static function delete($sectionID) {
        $conn = section::connect();
    
        // Check if the section exists
        $checkQuery = $conn->prepare("SELECT * FROM section_table WHERE ID = ?");
        $checkQuery->execute(array($sectionID));
    
        if ($checkQuery->rowCount() > 0) {
            // Section found, proceed with deletion
    
            // Delete associated PDFs
            $deletePdfQuery = $conn->prepare("DELETE FROM pdf_table WHERE sectionID = ?");
            if ($deletePdfQuery->execute(array($sectionID))) {
                // PDFs deleted successfully
    
                // Delete the section record from section_table
                $deleteQuery = $conn->prepare("DELETE FROM section_table WHERE ID = ?");
                if ($deleteQuery->execute(array($sectionID))) {
                    section::$alerts[] = "Section and associated PDFs deleted successfully.";
                } else {
                    section::$alerts[] = "Failed to delete the section.";
                }
            } else {
                section::$alerts[] = "Failed to delete associated PDFs.";
            }
        } else {
            // Section not found
            section::$alerts[] = "Section not found.";
        }
    }

}
?>