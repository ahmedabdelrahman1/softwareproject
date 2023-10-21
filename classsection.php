<?php
class section {
    public static $alerts=[];
    public static function connect(){
        $conn=new PDO("mysql:host=localhost;dbname=miu","root","");
        return $conn;
    }
    public static function insert($name,$courseID,$detail){
        $add=section::connect()->perpare("INSERT INTO section_table() VALUE(?,?,?,?,?)");
        $add->execute(array($name,$courseID,$detail));
        if($add){
            section::$alerts[]="Added!";
         }
         else{
            section::$alerts[]="Not added!";
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


}
?>