<?php
class coursedetails {
    public static $alerts = [];

    public static function connect() {
        $conn = new PDO("mysql:host=localhost;dbname=miu", "root", "");
        return $conn;
    }

    public static function insert($Category, $level, $Duration, $courseinfo) {
        $conn = coursedetails::connect();

        $insertQuery = $conn->prepare("INSERT INTO coursedetails_table (Category, level, Duration, courseinfo) VALUES (?, ?, ?, ?)");
        $insertQuery->execute([$Category, $level, $Duration, $courseinfo]);

        if ($insertQuery) {
            coursedetails::$alerts[] = "Course details added!";
        } else {
            coursedetails::$alerts[] = "Failed to add course details.";
        }
    }
    
    public static function selectByCourseDetailsID($coursedetailsID) {
        $conn = coursedetails::connect();
    
        try {
            $selectQuery = $conn->prepare("SELECT * FROM coursedetails_table WHERE ID = ?");
            if ($selectQuery->execute([$coursedetailsID])) {
                $courseDetails = $selectQuery->fetch(PDO::FETCH_ASSOC);
                return $courseDetails;
            } else {
                // Handle the case where the query did not execute successfully
                return null;
            }
        } catch (PDOException $e) {
            // Handle exceptions here, e.g., log the error
            return null;
        }
    }
    
}
?>