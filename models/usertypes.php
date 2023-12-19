<?php
require_once("Models.php");

class usertype extends Model
{
    public $ID;
    public $UserTypeName;
    public $ArrayOfPages;

    public function __construct($id = "", $UserTypeName = "")
    {
        $this->db = $this->connect();

        $this->ID = $id;
        $this->UserTypeName = $UserTypeName;
    }

    public function insert($usertype_id, $page_id)
    {
        $sql = "INSERT INTO usertype_pages (usertype_id, page_id) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('ii', $usertype_id, $page_id);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function delete($usertype_id, $page_id)
    {
        $sql = "DELETE FROM usertype_pages WHERE usertype_id = ? AND page_id = ?";
        $stmt = $this->db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('ii', $usertype_id, $page_id);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function selectbyusertype($usertype_id)
    {
        $pages = array();
    
        // Assuming you have a "pages" table with columns ID, name, and linkaddress
        $sql = "SELECT p.* FROM pages p
                INNER JOIN usertype_pages up ON p.ID = up.page_id
                WHERE up.usertype_id = ?";
        $stmt = $this->db->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param('i', $usertype_id);
            $stmt->execute();
            $result = $stmt->get_result();
    
            while ($row = $result->fetch_assoc()) {
                $pages[] = $row;
            }
    
            $stmt->close();
        }
    
        $this->setArraypages($pages);
    }

    public function setArraypages($arraypages)
    {
        $this->ArrayOfPages = $arraypages;
    }

    public function getArraypages()
    {
        return $this->ArrayOfPages;
    }
}
