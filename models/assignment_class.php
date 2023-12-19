<?php
require_once("Models.php");
class assignment extends Model
{
    private $cm_ID;
    private $file;
    private $name;
    private $grade;

    public function __construct($cm_id = "", $name = "", $file = "", $grade = NULL, $id = "")
    {
        $this->db = $this->connect();

        $this->cm_ID = $cm_id;
        $this->name = $name;
        $this->file = $file;
    }

    public function submit($studentID, $sectionID)
    {
        $allowedExtensions = ['pdf', 'doc', 'docx', 'txt'];

        if (!isset($this->file['file']['name']) || !isset($this->file['file']['type']) || !isset($this->file['file']['tmp_name']) || !isset($this->file['file']['error']) || !isset($this->file['file']['size'])) {
            Student::$alerts[] = "Invalid file provided.";
            return;
        }

        $extension = pathinfo($this->file['file']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($extension), $allowedExtensions)) {
            Student::$alerts[] = "Invalid file type. Allowed types are: " . implode(', ', $allowedExtensions);
            return;
        }

        $uploadDir = '../assignments/';
        $uploadedFile = $uploadDir . basename($this->file['file']['name']);

        /* if (file_exists($uploadedFile)) {
            course_matrial::$alerts[] = "File with the same name already exists.";
            return;
        }*/

        if (!move_uploaded_file($this->file['file']['tmp_name'], $uploadedFile)) {
            $sql = "INSERT INTO assignment(sectionID,cm_ID, studentID,grade,name,file) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("iiiiss", $sectionID, $this->cm_ID, $studentID, $this->grade, $this->name, $uploadedFile);
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

    public function selecrbycm_id()
    {
        $sql = "SELECT * FROM assignment WHERE cm_ID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $this->cm_ID);
        $stmt->execute();
        $result = $stmt->get_result();
        $fetch = $result->fetch_all(MYSQLI_ASSOC);
        return $fetch;
    }

    public function grade($id, $grade)
    {
        $sql = "UPDATE assignment SET grade = ? WHERE ID = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ii", $grade, $id);
            $stmt->execute();

            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                return true; // Update successful
            } else {
                return false; // No rows were updated
            }

    }
}
