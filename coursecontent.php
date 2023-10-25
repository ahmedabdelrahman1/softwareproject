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
    include("navbar.php");
    ?>

    <div class="container mt-4">
        <h1>Welcome to Your Course Page</h1>
        <p>This is where you can access your lectures and assignments.</p>

        <?php
        if (isset($_GET['course_id'])) {
            $course_id = $_GET['course_id'];
            echo "Course ID: " . $course_id;
        }

        require './classsection.php';
        $sections = section::selectByCourse($course_id);

        if (count($sections) > 0) {
            foreach ($sections as $value) {
                echo '<div class="card">';
                echo '    <div class="card-body">';
                echo '        <h5 class="card-title">' . $value['name'] . '</h5>';
                echo '        <p class="card-text">' . $value['detials'] . '</p>';
                echo '        <a href="content.php?title=' . $value['name'] . '&sectionID=' . $value['ID'] . '" class="btn btn-primary">Go to ' . $value['name'] . '</a>';
                echo '    </div>';

                // Show delete button
                echo '    <div class="card-body">';
                echo '        <a href="coursecontent.php?course_id=' . $course_id . '&delete_section=' . $value['ID'] . '" class="btn btn-danger btn-sm delete-btn">Delete</a>';
                echo '    </div>';
                echo '</div>';
            }
        }
        ?>

        <?php
        if (isset($_GET['delete_section'])) {
            $section_id_to_delete = $_GET['delete_section'];
            // Implement the delete function here
            section::delete($section_id_to_delete);

            // Redirect back to the course content page
            header('Location: coursecontent.php?course_id=' . $course_id);
        }
        ?>
<?php
echo '<form method="POST" action="coursecontent.php?course_id=' . $course_id.'" id="addSectionForm" style="display: none;">';
?>
<?php

if(isset($_SESSION['type']) && $_SESSION['type'] == 'instructor')
{
?>
        <div class="form-group">
            <label for="sectionName">Section Name:</label>
            <input type="text" class="form-control" id="sectionName" name="sectionName" required>
            <label for="sectionName">Details:</label>
            <input type="text" class="form-control" id="sectionDetails" name="sectionDetails" required>
        </div>
        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
        <button type="submit" class="btn btn-primary">Add Section</button>
    </form>

    <div id="addSectionButtonContainer">
        <button type="button" class="btn btn-primary" id="showFormButton">Add section</button>
    </div>
</div>

<?php
}
if (isset($_POST['sectionName']) && isset($_POST['sectionDetails']) && isset($_POST['course_id'])) {
    $sectionName = $_POST['sectionName'];
    $sectionDetails = $_POST['sectionDetails'];
    $courseID = $_POST['course_id'];

    section::insert($sectionName, $courseID, $sectionDetails);

    // Redirect back to the page where you added the section
    header('Location: coursecontent.php?course_id=' . $courseID);
}
?>
<style>
    /* Add spacing between elements */
    .card {
        margin-top: 15px;
    }
</style>

<script>
    document.getElementById("showFormButton").addEventListener("click", function() {
        // Hide the "Add Section" button
        document.getElementById("addSectionButtonContainer").style.display = "none";
        // Show the form
        document.getElementById("addSectionForm").style.display = "block";
    });

</script>
</div>
    
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

