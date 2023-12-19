<?php
require_once("Models.php");

class pages extends Model
{

    private $id;
    private $name;
    private $linkaddress;

    public function __construct($id = "", $name = "", $address = "")
    {
        $this->db = $this->connect();

        $this->id = $id;
        $this->name = $name;
        $this->linkaddress = $address;
    }

    public function getallpages()
    {
        $sql = "SELECT * FROM pages";
        $result = $this->db->query($sql);
        return $result ;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setLinkaddress($linkaddress)
    {
        $this->linkaddress = $linkaddress;
    }


    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLinkaddress()
    {
        return $this->linkaddress;
    }

}
