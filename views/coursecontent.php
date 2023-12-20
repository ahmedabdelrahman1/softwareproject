<!DOCTYPE html>
<html lang="en">
   
<?php   
            session_start();
            include("partials/head.php");
           
    echo'<body>';
            include("partials/navbar.php");
    ?>

    <div class="container mt-4">
        <h1>Welcome to Your Course Page</h1>
        <p>This is where you can access your lectures and assignments.</p>

        <?php
        if (isset($_GET['course_id'])) {
            $course_id = $_GET['course_id'];
        }
        
        require '../models/classsection.php';
        $sectionobject=section::getInstance();
        $sections = $sectionobject->selectByCourse($course_id);

        if (count($sections) > 0) {
            foreach ($sections as $value) {
                echo '<div class="card">';
                echo '    <div class="card-body">';
                echo '        <h5 class="card-title">' . $value['name'] . '</h5>';
                echo '        <p class="card-text">' . $value['detials'] . '</p>';
                echo '        <a href="content.php?title=' . $value['name'] . '&sectionID=' . $value['ID'] . '" class="btn btn-primary">Go to ' . $value['name'] . '</a>';
                echo '    </div>';

                // Show delete button
                if(isset($_SESSION['type']) && $_SESSION['type'] == 'instructor')
{
    echo '<form method="post" action="../controller/section_controller.php">';
    echo '        <div class="card-body">';
    echo'<input type="hidden" name="action" value="delete">';
    echo'<input type="hidden" name="course_id" value=" '. $course_id .'">';
    echo '            <button type="submit" name="delete_section" value="' . $value['ID'] . '" class="btn btn-danger btn-sm delete-btn">Delete</button>';
    echo '        </div>';
                echo '</div>';
                echo '</form>';
}
            }
        }
        ?>

       
<?php
if(isset($_SESSION['type']) && $_SESSION['type'] == 'instructor')
{
echo '<form method="POST" action="../controller/section_controller.php?course_id=' . $course_id.'" id="addSectionForm" style="display: none;">';
echo'<input type="hidden" name="action" value="create">';
?>
        <div class="form-group">
            <label for="sectionName">Section Name:</label>
            <input type="text" class="form-control" id="sectionName" name="sectionName" required>
            <label for="sectionName">Details:</label>
            <input type="text" class="form-control" id="sectionDetails" name="sectionDetails" required>
        </div>
        <input type="hidden" name="course_id" value="<?php $course_id; ?>">
        <button type="submit" class="btn btn-primary">Add Section</button>
    </form>

    <div id="addSectionButtonContainer">
        <button type="button" class="btn btn-primary" id="showFormButton">Add section</button>
    </div>
</div>

<?php
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
           include("partials/footer.php")
        ?>
        
       
</body> 
</html>

