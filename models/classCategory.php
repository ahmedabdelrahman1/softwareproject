<?php

require_once("Models.php");

class Category extends Model {
    private $id;
    private $name;
    private static $alerts;
    public function __construct($id, $name) {
        $this->db = $this->connect();
        $this->id = $id;
        $this->name = $name;
    }

    public function addCategory($name) {
    $sql = "INSERT INTO category(name) VALUES(?)";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param('s', $name);
    if ($stmt->execute()) {
        Category::$alerts[] = "Added!";
    } else {
        Category::$alerts[] = "Not added!";
    }
    $stmt->close();
    }

    public function getAllCategories() {

        $getAllCategories = "SELECT * FROM category";
        $result = $this->db->query($getAllCategories);
        return $result;

        // $result = $this->db->query("SELECT * FROM category");
        // $categories = [];

        // while ($row = $result->fetch_assoc()) {
        //     $categories[] = new Category($row['id'], $row['name']);
        // }

        // return $categories;
    }

    public function deleteAll() {
        $result = $this->db->query("DELETE FROM category");
        return $result;
    }

    public function deleteByID($id) {
        $stmt = $this->db->prepare("DELETE FROM category WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }

    // Setters and getters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
}

?>
