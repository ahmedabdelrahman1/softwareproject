<?php
   require './classpdf.php';
     if (isset($_POST['buttonupload'])){
        $name=$_POST['name'];
        if(isset($_FILES['file'])){
            if ($_FILES['file']['type'] == 'application/pdf') {
                $pdf_file = $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], 'pdf/'.$pdf_file);
                //echo "PDF uploaded";
            } else {
                echo "Please upload a PDF file.";
                return false;
            }
        }
        if(!empty($name)){
            pdf::insert($name,$pdf_file);
        }
        else{
            pdf::$alerts[]="Fill the fields";
        }
     }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>7GES - Courses </title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="static/assets/favicon.jpg" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="static/css/styles.css" rel="stylesheet" /> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
        <style>
        #drop-area {
            border: 2px dashed #ccc;
            border-radius: 20px;
            width: 1300px;
            height: 300px;
            text-align: center;
            padding: 15px;
            cursor: pointer;
        }

        #fileInput {
            display: none;
        }

        #file-label {
            cursor: pointer;
        }
        #name{
            padding:20px;
        }
        #file-display {
            width: 1300px;
            height: 300px;
            text-align: center;
            padding: 15px;
            cursor: pointer;
        }
    </style>
    </head>
<body>
<?php 
            include("navbar.php")
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
              else
              {
                echo " no alerts";
              }
            ?>
    </div>
   <div class="container mt-5">
        <h2>Drag and Drop File Upload</h2>
        <form method="post" action="" enctype="multipart/form-data">
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
            include("footer.php")
        ?>
        <!-- Bootstrap core JS-->
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
