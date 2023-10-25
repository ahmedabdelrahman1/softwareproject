<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Section - Profile </title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="static/assets/section.jpg" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="static/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <?php 
        session_start();
            include("navbar.php")
        ?>
        <!-- Page content-->
        <div class="container py-5 bg-body-tertiary"> 
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 g-3">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm border-bottom border-5">
                        <div class="card-header bg-white text-center py-4">
                            <img src="static/assets/img/placeholder.png" alt="..." class="rounded-circle">
                            <h1 class="card-title h5 my-3">Denamse Angono Derkos Tirel</h1>
                            <p class="card-text mb-3">tirelangono@gmail.com</p>
                            <p class="card-text mb-3">Joined 3y 6m on Section</p>

                            <a href="#" type="submit" class="btn btn-primary btn-m">Edit Profile</a>
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