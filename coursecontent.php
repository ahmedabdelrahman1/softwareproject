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
    </head>
<body>
<?php 
            include("navbar.php")
        ?>
<div class="container mt-4">
    <!-- Content for the course page goes here -->
    <h1>Welcome to Your Course Page</h1>
    <p>This is where you can access your lectures and assignments.</p>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Lectures</h5>
            <p class="card-text">Click here to access your lectures.</p>
            <a href="content.php?title=Lectures" class="btn btn-primary">Go to Lectures</a>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Assignments</h5>
            <p class="card-text">Click here to access your assignments.</p>
            <a href="content.php?title=Assignments" class="btn btn-primary">Go to Assignments</a>
        </div>
    </div>

    <form method="POST" action="process_section.php" id="addSectionForm" style="display: none;">
        <div class="form-group">
            <label for="sectionName">Section Name:</label>
            <input type="text" class="form-control" id="sectionName" name="sectionName" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Section</button>
    </form>

    <div id="addSectionButtonContainer">
        <button type="button" class="btn btn-primary" id="showFormButton">Add section</button>
    </div>
</div>

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

    $('#addSectionForm').submit(function(e) {
        e.preventDefault();
        var sectionName = $('#sectionName').val();
        
        // Create a new section and append it to the container
        var newSection = `
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">${sectionName}</h5>
                    <p class="card-text">Click here to access your ${sectionName.toLowerCase()}.</p>
                    <a href="content.php?title=${sectionName}" class="btn btn-primary">Go to ${sectionName}</a>
                </div>
            </div>
        `;
        $('#sectionContainer').append(newSection);
        
        // Reset the form and show the "Add Section" button again
        $('#sectionName').val('');
        $('#addSectionForm').hide();
        $('#addSectionButtonContainer').show();
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

