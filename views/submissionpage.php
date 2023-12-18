<!DOCTYPE html>
<html lang="en">
<?php   
          session_start();
            include("partials/head.php");
           
    echo'<body>';
            include("partials/navbar.php");

    ?>
 <body>
<?php
 if (isset($_GET['title'])) {
    $value = unserialize(urldecode($_GET['title']));
    $title=$value['name'];
    $sectionId=$value['sectionID'];
    echo "<h1>$title</h1>";
    echo "<hr>";
 }
    ?>

<form method="post" action="../controller/course_matrial_controller.php" enctype="multipart/form-data">
            <?php
            echo '    <input type="hidden" name="sectionID" value="' . $sectionId . '">';

            ?>
    <label id="name">Enter the name of the course matrial </label>
    <input type="text" name="name" placeholder="Enter document name">
    <div id="drop-area" style="border: 2px dashed #ccc; border-radius: 20px; width: 1300px; height: 300px; text-align: center; padding: 15px; cursor: pointer;">
    <input type="file" id="fileInput" name="file"  />
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


<?php 
           include("partials/footer.php")
        ?>
        
    
 </body>

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

    // Rest of your JavaScript code
    // ...
</script>
</html>