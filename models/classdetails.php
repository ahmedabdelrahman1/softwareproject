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
    public static function deleteByID($coursedetailsID) {
        $conn = coursedetails::connect();
    
        $deleteQuery = $conn->prepare("DELETE FROM coursedetails_table WHERE ID = ?");
        if ($deleteQuery->execute([$coursedetailsID])) {
            coursedetails::$alerts[] = "Course details deleted!";
        } else {
            coursedetails::$alerts[] = "Failed to delete course details.";
        }
    }
    public static function updateByID($coursedetailsID, $newCategory, $newLevel, $newDuration, $newCourseInfo) {
        $conn = coursedetails::connect();
    
        // Check if the course details exist
        $checkQuery = $conn->prepare("SELECT * FROM coursedetails_table WHERE ID = ?");
        $checkQuery->execute([$coursedetailsID]);
    
        if ($checkQuery->rowCount() > 0) {
            // Course details found, proceed with updating
    
            $updateQuery = $conn->prepare("UPDATE coursedetails_table SET Category = ?, level = ?, Duration = ?, courseinfo = ? WHERE ID = ?");
            
            if ($updateQuery->execute([$newCategory, $newLevel, $newDuration, $newCourseInfo, $coursedetailsID])) {
                coursedetails::$alerts[] = "Course details updated successfully.";
            } else {
                coursedetails::$alerts[] = "Failed to update course details.";
            }
        } else {
            // Course details not found
            coursedetails::$alerts[] = "Course details not found.";
        }
    }
    
}
?>