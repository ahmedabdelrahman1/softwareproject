<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("partials/head.php");
require_once("../models/assignment_class.php");

echo '<body>';
include("partials/navbar.php");

?>
<div class="container mt-4">
        <?php
        if (isset($_GET['title'])) {
                $value = unserialize(urldecode($_GET['title']));
                $title = $value['name'];
                $sectionId = $value['sectionID'];
                $file = $value['file'];
                $fileID = $value['id'];
                echo "<h1>$title</h1>";
                echo "<hr>";
      

        if ($_SESSION['type'] == 'student') {

                echo '<h5> Click to download </h5><br>';
                echo '<a href="course_matrial/' . $file . '" download="' . $file . '" class="text-primary fs-4 course_matrial-link">
                    <i class="bi bi-file-earmark fs-4"></i>' . $title . '
                </a>';
        ?>

                <form method="post" action="../controller/student_controller.php" enctype="multipart/form-data">
                        <?php
                        echo '    <input type="hidden" name="sectionID" value="' . $sectionId . '">';
                        echo '    <input type="hidden" name="cm_id" value="' . $fileID . '">';
                        echo '    <input type="hidden" name="studentID" value="' . $_SESSION["user_id"] . '">';
                        echo '    <input type="hidden" name="name" value="' . $title . 'assignment' . '">';
                        ?>
                        <input type="hidden" name="action" value="submit">
                        <div id="drop-area" style="border: 2px dashed #ccc; border-radius: 20px; width: 1300px; height: 300px; text-align: center; padding: 15px; cursor: pointer;">
                                <input type="file" id="fileInput" name="file" />
                                <label for="fileInput" id="file-label">
                                        Drag & Drop files here or click to browse
                                </label>
                                <div id="file-display">
                                        <i class="bi bi-file-pdf"></i>
                                        <span id="file-name">No file selected</span>
                                </div>
                        </div>
                        <button type="submit" name="buttonupload" value="Register" class="btn btn-primary mt-2">Upload</button>
                </form>

</div>

<?php
                include("partials/footer.php")
?>
<script>
        const dropArea = document.getElementById('drop-area');

        dropArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropArea.style.border = '2px dashed #000';
        });

        dropArea.addEventListener('dragleave', (e) => {
                e.preventDefault();
                dropArea.style.border = '2px dashed #ccc';
        });

        dropArea.addEventListener('drop', (e) => {
                e.preventDefault();
                dropArea.style.border = '2px dashed #ccc';
                const fileInput = document.getElementById('fileInput');
                const file = e.dataTransfer.files[0];
                fileInput.files = e.dataTransfer.files;
                handleFile(file);
        });
</script>

<script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('fileInput');
        const fileDisplay = document.getElementById('file-display');
        const fileName = document.getElementById('file-name');

        dropArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropArea.style.border = '2px dashed #000';
        });

        dropArea.addEventListener('dragleave', (e) => {
                e.preventDefault();
                dropArea.style.border = '2px dashed #ccc';
        });

        dropArea.addEventListener('drop', (e) => {
                e.preventDefault();
                dropArea.style.border = '2px dashed #ccc';
                const file = e.dataTransfer.files[0];
                fileInput.files = e.dataTransfer.files;
                handleFile(file);
        });

        fileInput.addEventListener('change', () => {
                const file = fileInput.files[0];
                handleFile(file);
        });

        function handleFile(file) {
                fileName.textContent = file.name;
                // Add styling for the inner border if needed
                // Remove the outer border if needed
                // You can add additional logic here based on your requirements
        }
</script>
<script type="text/javascript">
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('fileInput');
        const fileDisplay = document.getElementById('file-display');
        const fileName = document.getElementById('file-name');

        fileInput.addEventListener('change', () => {
                const file = fileInput.files[0];
                if (file) {
                        fileDisplay.innerHTML = ''; // Clear previous content
                        const fileIcon = document.createElement('i');
                        fileIcon.className = 'bi bi-file'; // Use a generic file icon
                        fileName.textContent = file.name;
                        fileDisplay.appendChild(fileIcon);
                        fileDisplay.appendChild(fileName);
                } else {
                        fileDisplay.innerHTML = '<i class="bi bi-file"></i><span id="file-name">No file selected</span>';
                }
        });
</script>
<?php
        } else {
                echo '<h5> Click to download </h5><br>';
                echo '<a href="course_matrial/' . $file . '" download="' . $file . '" class="text-primary fs-4 course_matrial-link">
                    <i class="bi bi-file-earmark fs-4"></i>' . $title . '
                </a>';

                $objectassignment= new assignment($fileID,$title,$file,NULL);
               

                echo '
                <div class="container mt-5">
                  <h2>Grade Table</h2>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Assignment</th>
                        <th scope="col">Grade</th>
                      </tr>
                    </thead>
                    <tbody>';

                    $fetch=$objectassignment->selecrbycm_id();
                    
                    foreach( $fetch as $assignment )
                    
                    echo ' <tr>
                        <td><a href="assignment/' . $assignment['file'] . '" download="' . $assignment['file'] . '" class="text-primary fs-4 course_matrial-link">
                        <i class="bi bi-file-earmark fs-4"></i>' . $assignment['name'] . '
                        </a></td>
                        <td><input type="text" class="form-control" placeholder="Grade" value="'.$assignment['grade'].'"></td>
                      </tr>';

                   echo' </tbody>
                  </table>
                </div>';
?>

<?php
        }
}
?>
</body>


</html>