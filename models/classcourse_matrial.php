<?php

require_once("Models.php");

class course_matrial extends Model
{

    private $id;
    private $name;
    private $File;
    private $sectionid;
    private $submitvalue;
    public static $alerts = [];

    public function __construct($id = "", $name = "", $File = "", $sectionid = "")
    {
        $this->db = $this->connect();

        $this->id = $id;
        $this->name = $name;
        $this->File = $File;
        $this->sectionid = $sectionid;
    }

    public function insert($name, $file, $sectionID,$submitvalue=NULL,$submitdeadline=NULL)
    {
        $allowedExtensions = ['pdf', 'doc', 'docx', 'txt'];
        $this->submitvalue=$submitvalue;
    
        if (!isset($file['file']['name']) || !isset($file['file']['type']) || !isset($file['file']['tmp_name']) || !isset($file['file']['error']) || !isset($file['file']['size'])) {
            course_matrial::$alerts[] = "Invalid file provided.";
            return;
        }
    
        $extension = pathinfo($file['file']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($extension), $allowedExtensions)) {
            course_matrial::$alerts[] = "Invalid file type. Allowed types are: " . implode(', ', $allowedExtensions);
            return;
        }
    
        $uploadDir = '../files/';
        $uploadedFile = $uploadDir . basename($file['file']['name']);

       /* if (file_exists($uploadedFile)) {
            course_matrial::$alerts[] = "File with the same name already exists.";
            return;
        }*/
    
        if (!move_uploaded_file($file['file']['tmp_name'], $uploadedFile)) {
            $sql = "INSERT INTO course_matrial_table(name,file, sectionID,submission,deadline) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssiis", $name, $uploadedFile, $sectionID,$submitvalue,$submitdeadline);
            if ($stmt->execute()) {
              header("Location: ../views/content.php?sectionID=$sectionID");
                exit();
            } else {
                course_matrial::$alerts[] = "Not added!";
            }
        } else {
            course_matrial::$alerts[] = "Failed to upload the file.";
        }
    }
    
    


    

    public function selectBySectionID($sectionID)
    {
        $sql = "SELECT * FROM course_matrial_table WHERE sectionID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $sectionID);
        $stmt->execute();
        $result = $stmt->get_result();
        $fetch = $result->fetch_all(MYSQLI_ASSOC);
        return $fetch;
    }

    public function delete($course_matrialID)
    {
        $sql = "SELECT file, sectionID FROM course_matrial_table WHERE ID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $course_matrialID); // Use bind_param for binding parameters
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc(); // Use get_result and fetch_assoc for fetching results

        if ($result) {
            $course_matrialFile = $result['course_matrial_file'];
            $sectionID = $result['sectionID'];

            // Delete the course_matrial record from the database
            $deleteQuery = $this->db->prepare("DELETE FROM course_matrial_table WHERE ID = ?");
            $deleteQuery->bind_param("i", $course_matrialID); // Use bind_param for binding parameters
            $deleteQuery->execute();

            // Delete the actual course_matrial file from the server
            if (unlink("course_matrial/" . $course_matrialFile)) {
                header("Location: ../views/content.php?sectionID=$sectionID");
                exit; // Stop script execution after redirection
            } else {
                // Handle file deletion error
                course_matrial::$alerts[] = "Failed to delete the course_matrial file.";
            }
        } else {
            // Handle course_matrial record not found
            course_matrial::$alerts[] = "course_matrial record not found.";
        }
    }

    public function getsubmitvalue(){
            return $this->submitvalue;
    }
}
