

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Section - Courses </title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="static/assets/favicon.jpg" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="static/css/styles.css" rel="stylesheet" /> 
        
    </head>
<body>
<?php 
session_start();
            include("navbar.php")
        ?>
<div class="container mt-4">
<?php
 @include 'config.php';
 require './classpdf.php';
 if (isset($_GET['title'])) {
    $title = $_GET['title'];
    echo "<h1>$title</h1>";
    echo "<hr>";

    if (isset($_GET['pdfID'])) {
        $pdfId = $_GET['pdfID'];
        pdf::delete($pdfId);
    }

    if (isset($_GET['sectionID'])) {
        $sectionId = $_GET['sectionID'];

        if (count(pdf::selectBySectionID($sectionId)) > 0) {
            $fetch = pdf::selectBySectionID($sectionId);
            foreach ($fetch as $value) {
                echo '<a href="pdf/' . $value['pdf_file'] . '" download="' . $value['pdf_file'] . '" class="text-primary fs-4 pdf-link">
                    <i class="bi bi-file-earmark-pdf fs-4"></i>' . $value['name'] . '
                </a>
                <a href="content.php?pdfID=' . $value['id'] . '&sectionID=' . $sectionId . '" class="btn btn-danger btn-sm delete-btn" style="display: none">Delete</a><br>';
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
    if (isset($_GET['pdfID'])) {
        $pdfId = $_GET['pdfID'];
        pdf::delete($pdfId);
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
        </a>
        <a href="content.php?pdfID=' . $value['id'] . '&sectionID=' . $sectionId . '" class="btn btn-danger btn-sm delete-btn" style="display: none">Delete</a><br>';
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
            include("footer.php")
        ?>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="static/js/scripts.js"></script>
        <script src="static/js/masonry.js"></script>

        <script type="text/javascript">
            var elem = document.querySelector('.gallery');
            var msnry = new Masonry( elem, {
                // options
                itemSelector: '.gallery-item',
                columnWidth: '.gallery-item',
            });

            // element argument can be a selector string
            //   for an individual element
            var msnry = new Masonry( '.gallery', {// options});
        </script>

        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    
</body>
</html>