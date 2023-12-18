

<!DOCTYPE html>
<html lang="en">
    
<?php   
            session_start();
            include("partials/head.php");
           
    echo'<body>';
            include("partials/navbar.php");
            @include '../db/config.php';
            require '../models/classcourse_matrial.php';
    ?>
<div class="container mt-4">
<?php
 
 if (isset($_GET['title'])) {
    $title = $_GET['title'];
    echo "<h1>$title</h1>";
    echo "<hr>";

    $course_matrialObject=new course_matrial();
    if (isset($_GET['sectionID'])) {
        $sectionId = $_GET['sectionID'];
        echo $sectionId;
        if (count($course_matrialObject->selectBySectionID($sectionId)) > 0) {
            $fetch = $course_matrialObject->selectBySectionID($sectionId);
            foreach ($fetch as $value) {
                if($value['submission']==NULL)
                echo '<a href="submissionpage.php?title=' . urlencode(serialize($value)) . '" class="text-primary fs-4 course_material-link">Link Text</a>
                    <i class="bi bi-file-earmark fs-4"></i>' . $value['name'] . '
                </a>';
                else if($value['submission']==1)
                echo '<a href="submissionpage.php?title=' .urlencode(serialize($value)). '&sectioID='.$sectionId.' class="text-primary fs-4 course_matrial-link">
                    <i class="bi bi-file-earmark fs-4"></i>' . $value['name'] . '
                </a>';
                echo '<form method="post" action="../controller/course_matrial_controller.php">';
                echo '    <input type="hidden" name="action" value="delete">';
                echo '    <input type="hidden" name="course_matrialID" value="' . $value['id'] . '">';
                echo '    <input type="hidden" name="sectionID" value="' . $sectionId . '">';
                echo '    <button type="submit" class="btn btn-danger btn-sm delete-btn" style="display: none">Delete</button>';
                echo '</form><br>';
            }
        }
      

if(isset($_SESSION['type']) && $_SESSION['type'] == 'instructor')
{

        echo '<a href="import.php?&sectionID=' . $sectionId . '" class="btn btn-primary ">+</a>';
        echo '<a style=" margin:20px" class="btn btn-primary add-course_matrial-btn">-</a>';
}
    } else {
        echo "Section not found.";
    }
}
else {
    if (isset($_GET['sectionID'])) {
        // Retrieve the section ID from the query parameter
        $sectionId = $_GET['sectionID'];
       
    
        // Now you can use the $sectionId variable in your code
    }
    // Prepare the SQL statement with a question mark as a placeholder
    $sql = "SELECT name FROM section_table WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind the section ID as an integer
    $stmt->bind_param("i", $sectionId);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sectionName = $row['name'];
        $title = $sectionName;
        echo "<h1>$title</h1>";
        echo "<hr>";
    }
    
    $course_matrialObject=new course_matrial();
    if (count($course_matrialObject->selectBySectionID($sectionId)) > 0) {
        $fetch = $course_matrialObject->selectBySectionID($sectionId);
        foreach ($fetch as $value) {
            echo '<a href="course_matrial/' . $value['file'] . '" download="' . $value['file'] . '" class="text-primary fs-4 course_matrial-link">
            <i class="bi bi-file-earmark fs-4"></i>' . $value['name'] . '
        </a>';
        echo '<form method="post" action="../controller/course_matrial_controller.php">';
        echo '    <input type="hidden" name="action" value="delete">';
        echo '    <input type="hidden" name="course_matrialID" value="' . $value['id'] . '">';
        echo '    <input type="hidden" name="sectionID" value="' . $sectionId . '">';
        echo '    <button type="submit" class="btn btn-danger btn-sm delete-btn" style="display: none">Delete</button>';
        echo '</form><br>';
        }
    }
     else {
        echo "Section not found.";
    }
    echo '<a href="import.php?&sectionID=' . $sectionId .' " class="btn btn-primary">+</a>';
    echo '<a style=" margin:20px"  class="btn btn-primary add-course_matrial-btn">-</a>';
}
   




?>
</div>
<script>
    // Function to toggle the visibility of "Delete" anchors
    function toggleDeleteAnchors() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.style.display = button.style.display === 'none' ? 'inline' : 'none';
        });
    }

    // Add an event listener to the button that triggers the visibility toggle
    const addButton = document.querySelector('.add-course_matrial-btn');
    addButton.addEventListener('click', toggleDeleteAnchors);
</script>
<?php 
           include("partials/footer.php")
        ?>
        
    
</body>
</html>