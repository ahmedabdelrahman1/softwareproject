<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>7GES - Profile </title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="static/assets/favicon.jpg" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="static/css/styles.css" rel="stylesheet" />


    <style>
        /* Pop-up styles */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
            align-items: center;
            justify-content: center;
        }
        
        .popup {
            background: white;
            width:500px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        /* Close button */
        .close-button {
            position: absolute; 
            top: 25px; 
            right: 20px; 
            cursor: pointer; 
            font:20px 
        }
    </style>


        <style>
        /* Style for the circular images */
        .circular-image {
            border-radius: 50%;
            width: 150px; /* Adjust the size as needed */
            height: 150px; /* Adjust the size as needed */
            object-fit: cover;
        }

        /* Center the images on the page */
        .center-images {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
        }
    </style>

    </head>
    <body>
        <!-- Responsive navbar-->
        <?php 
        include("config.php");
        session_start();
            include("navbar.php");

            
            // Replace $user_id with the actual user ID you want to retrieve
            $user_id = $_SESSION["user_id"];
            
            // SQL query to retrieve user data
            $sql = "SELECT fname, lname , email FROM user WHERE id = $user_id";
            
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $first_name = $row["fname"];
                $last_name = $row["lname"];
                $email = $row["email"];
            } else {
                echo "User not found";
            }
            
            $sql = "SELECT img_url FROM images WHERE user_id = $user_id ORDER BY img_id DESC";

$result = $conn->query($sql);
$images = $result->fetch_all(MYSQLI_ASSOC);
            


        ?>
        <!-- Page content-->
        <div class="container py-5 bg-body-tertiary"> 
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 g-3">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm border-bottom border-5">
                        <div class="card-header bg-white text-center py-4">
                            <!-- <img src="static/assets/img/placeholder.png" alt="..." class="rounded-circle"> -->
                            <div class="center-images">
        <?php
        if (!empty($images)) {
            foreach ($images as $image) {
                echo '<div class="col-md-4">';
                echo '<img src="uploads/' . $image['img_url'] . '" alt="User Image" class="circular-image img-thumbnail">';
                echo '</div>';
            }
        } else {
            echo '<p>No images available.</p>';
        }
        ?>
    </div>
                            <h1 class="card-title h5 my-3">
                            <p> Name: <?php echo $first_name.' '.$last_name; ?></p>
                            </h1>
                            <p> E-mail: <?php echo $email; ?></p>

                            <button id="openEditProfilePopup" type="submit" class="btn btn-primary btn-m">Edit Profile</button>
                            <button id="openEditImagePopup" type="submit" class="btn btn-primary btn-m">Edit Image</button>

                            <div class="overlay" id="editImagePopup">
    <div class="popup">
        <span style="cursor:pointer; marginright:30px font:20px" class="close-button" id="closeEditImagePopup">X</span>
        <h2 class="mb-4">Edit Image</h2>
        <form action="upload_pht.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="myimage" class="form-label">New Profile Picture</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="myimage" required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="submit">Upload</button>
                    </div>
                </div>
            </div>
            <!-- <button type="submit" class="btn btn-primary">Save Image</button> -->
        </form>
    </div>
</div>

            </div>
                        <div class="card-footer p-4 d-flex justify-content-between align-items-center">
                            <small class="text-danger">Subscription Expired</small>

                            <div class="btn-group">
                                <a href="#" type="button" class="btn btn-sm btn-outline-primary">Subscription</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Footer-->
        <?php 
            include("footer.php")
        ?>


<div class="overlay" id="editProfilePopup">
    <div class="popup">
    <span  class="close-button"  id="closeEditProfilePopup">X</span>
        <h2 class="mb-4">Edit Profile</h2>
        <form action="edit_user.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" class="form-control" name="fname" value="<?php echo $first_name?>" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="lname" value="<?php echo $last_name?>" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email" value="<?php echo $email?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>

        </form>
        
    </div>
</div>



    <!-- <button id="openEditProfilePopup">Edit Profile</button> -->

    <script>
        const openPopupButton = document.getElementById("openEditProfilePopup");
        const popup = document.getElementById("editProfilePopup");
        const closePopupButton = document.getElementById("closeEditProfilePopup");

        openPopupButton.addEventListener("click", function() {
            popup.style.display = "flex";
        });

        closePopupButton.addEventListener("click", function() {
            popup.style.display = "none";
        });
    </script>


<script>
    const openImagePopupButton = document.getElementById("openEditImagePopup");
    const imagePopup = document.getElementById("editImagePopup");
    const closeImagePopupButton = document.getElementById("closeEditImagePopup");

    openImagePopupButton.addEventListener("click", function() {
        imagePopup.style.display = "flex";
    });

    closeImagePopupButton.addEventListener("click", function() {
        imagePopup.style.display = "none";
    });
</script>












        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="static/js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>