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
      
        pdf::$alerts[] = "Added!";

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
}

?>