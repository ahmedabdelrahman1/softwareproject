<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Section - Bookmarks </title>
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
            <div class="text-sm-start text-lg-start mb-3">
                <h1>List of my bookmarks</h1>
                <p class="lead fw-normal text-muted">Explore Your List of Favorite Courses.</p>
            </div>

            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 g-3">
                <div class="col-md-12 table-responsive">
                    <table class="table table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Courses</th>
                                <th scope="col">Categories</th>
                                <th scope="col">Status</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Introduction to Python programming</td>
                                <td>Programming</td>
                                <td>Free</td>
                                <td>2 Weeks</td>
                                <td><a href="bookmarks.html" type="button" class="btn btn-sm btn-outline-primary">Remove</a></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Django - Beginners to advanced level</td>
                                <td>Web Developmwnt</td>
                                <td>USD 95.99</td>
                                <td>2 Weeks</td>
                                <td><a href="bookmarks.html" type="button" class="btn btn-sm btn-outline-primary">Remove</a></td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Introduction to SQL Database</td>
                                <td>Database</td>
                                <td>USD 25.50</td>
                                <td>2 Weeks</td>
                                <td><a href="bookmarks.html" type="button" class="btn btn-sm btn-outline-primary">Remove</a></td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Introduction to HTML & CSS</td>
                                <td>Programming</td>
                                <td>Free</td>
                                <td>2 Weeks</td>
                                <td><a href="bookmarks.html" type="button" class="btn btn-sm btn-outline-primary">Remove</a></td>
                            </tr>
                        </tbody>
                    </table>
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