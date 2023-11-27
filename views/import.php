<?php
session_start();
if (isset($_GET['sectionID'])) {
    // Retrieve the course_id from the query parameter
    $sectionId = $_GET['sectionID'];
    require '../models/classpdf.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php   
          
            include("partials/head.php");
           
    echo'<body>';
            include("partials/navbar.php");
    ?>
        <div>
            <?php
              if(count(pdf::$alerts)>0){
                $alert=pdf::$alerts;
                foreach($alert as $value)
                {
                    echo $value;
                }
              }
             
            ?>
    </div>
   <div class="container mt-5">
        <h2>Drag and Drop File Upload</h2>
        <form method="post" action="../controller/pdf_controller.php" enctype="multipart/form-data">
            <?php
            echo '    <input type="hidden" name="sectionID" value="' . $sectionId . '">';
}
            ?>
        <input type="hidden" name="action" value="create">
    <label id="name">Enter the name of the PDF </label>
    <input type="text" name="name" placeholder="Enter pdf name">
    <div id="drop-area" style="border: 2px dashed #ccc; border-radius: 20px; width: 1300px; height: 300px; text-align: center; padding: 15px; cursor: pointer;">
    <input type="file" id="fileInput" name="file" accept="application/pdf" />
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
    if (file.type === 'application/pdf') {
        fileName.textContent = file.name;// Add styling for the inner border
        // Remove the outer border
        // You can add additional logic here, such as displaying an icon for PDF.
    }
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
                    if (file.type === 'application/pdf') {
                        fileDisplay.innerHTML = ''; // Clear previous content
                        const pdfIcon = document.createElement('i');
                        pdfIcon.className = 'bi bi-file-pdf';
                        fileName.textContent = file.name;
                        fileDisplay.appendChild(pdfIcon);
                        fileDisplay.appendChild(fileName);
                    } else {
                        alert('Please upload a PDF file.');
                        fileInput.value = ''; // Reset the input
                    }
                } else {
                    fileDisplay.innerHTML = '<i class="bi bi-file-pdf"></i><span id="file-name">No file selected</span>';
                }
            });

            // Rest of your JavaScript code
            // ...
        </script>



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
    
</body>
</html>
