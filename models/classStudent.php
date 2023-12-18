<?php
require_once("Models.php");
require_once("classUser.php");
class Student extends User
{

    private $studentID;

    public function __construct($id = "")
    {
        $this->db = $this->connect();

        $this->studentID = $id;
    }

    public function submitassigment($studentID, $cm_id, $name, $file, $sectionID, $grade = NULL)
    {
        $allowedExtensions = ['pdf', 'doc', 'docx', 'txt'];

        if (!isset($file['file']['name']) || !isset($file['file']['type']) || !isset($file['file']['tmp_name']) || !isset($file['file']['error']) || !isset($file['file']['size'])) {
            Student::$alerts[] = "Invalid file provided.";
            return;
        }

        $extension = pathinfo($file['file']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($extension), $allowedExtensions)) {
            Student::$alerts[] = "Invalid file type. Allowed types are: " . implode(', ', $allowedExtensions);
            return;
        }

        $uploadDir = '../assignments/';
        $uploadedFile = $uploadDir . basename($file['file']['name']);

        /* if (file_exists($uploadedFile)) {
            course_matrial::$alerts[] = "File with the same name already exists.";
            return;
        }*/

        if (!move_uploaded_file($file['file']['tmp_name'], $uploadedFile)) {
            $sql = "INSERT INTO assignment(sectionID,cm_ID, studentID,grade,name,file) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("iiiiss", $sectionID, $cm_id, $studentID, $grade, $name, $uploadedFile);
            if ($stmt->execute()) {
                header("Location: ../views/content.php?sectionID=$sectionID");
                exit();
            } else {
                Student::$alerts[] = "Not added!";
            }
        } else {
            Student::$alerts[] = "Failed to upload the file.";
        }
    }
}
