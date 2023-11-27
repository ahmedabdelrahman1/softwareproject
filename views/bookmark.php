<!DOCTYPE html>
<html lang="en">
<?php   
            session_start();
            include("partials/head.php");
           
    echo'<body>';
            include("partials/navbar.php");
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
           include("partials/footer.php")
        ?>
       
    </body>
</html>