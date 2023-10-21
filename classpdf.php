<?php
class pdf {

    public static $alerts=[];
    public static function connect ()
    {
        $conn=new PDO("mysql:host=localhost;dbname=miu","root","");
        return $conn;
    }
    public static function insert($name,$pdf_file)
    {
        $add = pdf::connect()->prepare("INSERT INTO pdf_table(name, pdf_file) VALUES(?, ?)");
        $add->execute(array($name,$pdf_file));
        if($add){
           pdf::$alerts[]="Added!";
        }
        else{
            pdf::$alerts[]="Not added!";
        }
    }
    public static function select(){
        $list=pdf::connect()->prepare("SELECT *FROM pdf_table");
        $list->execute();
        $fetch=$list->fetchALL(PDO::FETCH_ASSOC);
        return $fetch;
    }
}

?>