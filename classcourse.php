<?php
class course {
    public static $alerts=[];
    public static function connect(){
        $conn=new PDO("mysql:host=localhost;dbname=miu","root","");
        return $conn;
    }
    public static function insert($name,$instructorID,$detail,$price,$sectionID){
        $add=course::connect()->perpare("INSERT INTO course_table() VALUE(?,?,?,?,?)");
        $add->execute(array($name,$instructorID,$detail,$price,$sectionID));
        if($add){
            course::$alerts[]="Added!";
         }
         else{
            course::$alerts[]="Not added!";
         }
    }
    public static function select(){
        $list=course::connect()->prepare("SELECT *FROM course_table");
        $list->execute();
        $fetch=$list->fetchALL(PDO::FETCH_ASSOC);
        return $fetch;
    }


}
?>