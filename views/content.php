

<!DOCTYPE html>
<html lang="en">
    
<?php   
            session_start();
            include("partials/head.php");
           
    echo'<body>';
            include("partials/navbar.php");
    ?>
<div class="container mt-4">
<?php
 @include 'config.php';
 require '../models/classpdf.php';
 if (isset($_GET['title'])) {
    $title = $_GET['title'];
    echo "<h1>$title</h1>";
    echo "<hr>";


    if (isset($_GET['sectionID'])) {
        $sectionId = $_GET['sectionID'];
        echo $sectionId;
        if (count(pdf::selectBySectionID($sectionId)) > 0) {
            $fetch = pdf::selectBySectionID($sectionId);
            foreach ($fetch as $value) {
                echo '<a href="pdf/' . $value['pdf_file'] . '" download="' . $value['pdf_file'] . '" class="text-primary fs-4 pdf-link">
                    <i class="bi bi-file-earmark-pdf fs-4"></i>' . $value['name'] . '
                </a>';
                echo '<form method="post" action="../controller/pdf_controller.php">';
                echo '    <input type="hidden" name="action" value="delete">';
                echo '    <input type="hidden" name="pdfID" value="' . $value['id'] . '">';
                echo '    <input type="hidden" name="sectionID" value="' . $sectionId . '">';
                echo '    <button type="submit" class="btn btn-danger btn-sm delete-btn" style="display: none">Delete</button>';
                echo '</form><br>';
            }
        }
      

if(isset($_SESSION['type']) && $_SESSION['type'] == 'instructor')
{

        echo '<a href="import.php?&sectionID=' . $sectionId . '" class="btn btn-primary ">+</a>';
        echo '<a style=" margin:20px" class="btn btn-primary add-pdf-btn">-</a>';
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
    
    // Rest of your code to retrieve and display PDFs
    if (count(pdf::selectBySectionID($sectionId)) > 0) {
        $fetch = pdf::selectBySectionID($sectionId);
        foreach ($fetch as $value) {
            echo '<a href="pdf/' . $value['pdf_file'] . '" download="' . $value['pdf_file'] . '" class="text-primary fs-4 pdf-link">
            <i class="bi bi-file-earmark-pdf fs-4"></i>' . $value['name'] . '
        </a>';
        echo '<form method="post" action="../controller/pdf_controller.php">';
        echo '    <input type="hidden" name="action" value="delete">';
        echo '    <input type="hidden" name="pdfID" value="' . $value['id'] . '">';
        echo '    <input type="hidden" name="sectionID" value="' . $sectionId . '">';
        echo '    <button type="submit" class="btn btn-danger btn-sm delete-btn" style="display: none">Delete</button>';
        echo '</form><br>';
        }
    }
     else {
        echo "Section not found.";
    }
    echo '<a href="import.php?&sectionID=' . $sectionId .' " class="btn btn-primary">+</a>';
    echo '<a style=" margin:20px"  class="btn btn-primary add-pdf-btn">-</a>';
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
    const addButton = document.querySelector('.add-pdf-btn');
    addButton.addEventListener('click', toggleDeleteAnchors);
</script>
<?php 
           include("partials/footer.php")
        ?>
        
    
</body>
</html>