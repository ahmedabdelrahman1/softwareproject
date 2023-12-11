<?php

require_once("Models.php");

class pdf extends Model
{

    private $id;
    private $name;
    private $File;
    private $sectionid;
    public static $alerts = [];

    public function __construct($id = "", $name = "", $File = "", $sectionid = "")
    {
        $this->db = $this->connect();

        $this->id = $id;
        $this->name = $name;
        $this->File = $File;
        $this->sectionid = $sectionid;
    }
    public function insert($name, $pdf_file, $sectionID)
    {
        $sql = "INSERT INTO pdf_table(name, pdf_file, sectionID) VALUES (?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $name, $pdf_file, $sectionID);

        if ($stmt->execute()) {
            header("Location: ../views/content.php?sectionID=$sectionID");
            exit(); // Make sure to exit after a header redirect
        } else {
            pdf::$alerts[] = "Not added!";
        }
    }

    public function selectBySectionID($sectionID)
    {
        $sql = "SELECT * FROM pdf_table WHERE sectionID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $sectionID);
        $stmt->execute();
        $result = $stmt->get_result();
        $fetch = $result->fetch_all(MYSQLI_ASSOC);
        return $fetch;
    }

    public function delete($pdfID)
    {
        $sql = "SELECT pdf_file, sectionID FROM pdf_table WHERE ID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $pdfID); // Use bind_param for binding parameters
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc(); // Use get_result and fetch_assoc for fetching results

        if ($result) {
            $pdfFile = $result['pdf_file'];
            $sectionID = $result['sectionID'];

            // Delete the PDF record from the database
            $deleteQuery = $this->db->prepare("DELETE FROM pdf_table WHERE ID = ?");
            $deleteQuery->bind_param("i", $pdfID); // Use bind_param for binding parameters
            $deleteQuery->execute();

            // Delete the actual PDF file from the server
            if (unlink("pdf/" . $pdfFile)) {
                header("Location: ../views/content.php?sectionID=$sectionID");
                exit; // Stop script execution after redirection
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
