<!DOCTYPE html>
<html lang="en">
    
<?php   
            session_start();
            include("partials/head.php");
           
    echo'<body>';
            include("partials/navbar.php");
    ?>
        <!-- Page content-->
        <div class="container-fluid py-5 bg-body-tertiary">
            <div class="col-lg-6 mx-auto">
                <form class="form-group">
                    <!-- <div class="row"> -->
                        <!-- <div class="col"> -->
                            <input class="form-control form-control" type="search" placeholder="Search for courses..."/>
                        <!-- </div> -->
                        <!-- <div class="col-auto"><button class="btn btn-primary" type="submit">Search</button></div> -->
                    <!-- </div> -->
                </form>
            </div>

            <div class="text-sm-start text-lg-center my-5">
                <h1>Courses List</h1>
                <p class="lead fw-normal text-muted">Explore Our Extensive Catalog of Courses for a World of Learning Opportunities.</p>
            </div>

            <?php
                    require '../models/classcourse.php';
?>

            <div  d="gallery" class="row row-cols-1 row-cols-sm-1 row-cols-md-2 g-3 gallery">
                <div class="col-md-9">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-5">
                        <?php
                       if (count(course::select()) > 0) {
    $fetch = course::select();
    foreach ($fetch as $value) {
        echo '<div class="col gallery-item">';
        echo '    <div class="card shadow-sm border-bottom border-5">';
        echo '        <a href="coursecontent.php?course_id=' . $value['ID'] . '" class="card-img">';
        echo '            <img class="bd-placeholder-img card-img-top" style="height: 225px;width: 100%;" src="static/assets/img/python.jpg">';
        echo '        </a>';
        echo '        <div class="card-body">';
        echo '            <h3 class="card-title h4">';
        echo '                Introduction to ' . $value['name'];
        echo '            </h3>';
        echo '            <p class="card-text text-muted">' . $value['preview'] . '</p>';
        echo '';
        echo '            <p class="card-text h6 mb-3">';
        echo '                <img class="rounded-circle me-1" style="height: 24px;width: 24px;" src="static/assets/img/clock.png">2 Hours &dash; <span class="text-primary fw-bold">Programming</span>';
        echo '            </p>';
        echo '';
        echo '            <div class="d-flex justify-content-between align-items-center">';
        echo '                <div class="btn-group">';
        echo '                    <a href="detail.php?course_id=' . $value['ID'] . '&detailsID=' . $value['detailsID'] . '" type="button" class="btn btn-sm btn-outline-secondary">View</a>';
        echo '                    <a href="bookmark.php" type="button" class="btn btn-sm btn-outline-primary">Bookmarks</a>';
        echo '                </div>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
}
?>
                        <div class="col gallery-item">
                            <div class="card shadow-sm border-bottom border-5">
                                <a href="detail.php" class="card-img">
                                    <img class="bd-placeholder-img card-img-top" style="height: 225px;width: 100%;" src="static/assets/img/django.jpg">
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title h4">
                                        Django - Beginners to advanced level
                                    </h3>
                                    <p class="card-text text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis libero et orci fringilla, eu varius neque eleifend.</p>

                                    <p class="card-text h6 mb-3">
                                        <img class="rounded-circle me-1" style="height: 24px;width: 24px;" src="static/assets/img/clock.png">2 Hours &dash; <span class="text-primary fw-bold">Programming</span>
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="detail.php" type="button" class="btn btn-sm btn-outline-secondary">View</a>

                                            <a href="bookmark.php" type="button" class="btn btn-sm btn-outline-primary">Bookmarks</a>
                                        </div>
                                        <small class="badge rounded-pill text-light bg-danger p-2 h6">USD 95.99</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col gallery-item">
                            <div class="card shadow-sm border-bottom border-5">
                                <a href="detail.php"a class="card-img">
                                    <img class="bd-placeholder-img card-img-top" style="height: 225px;width: 100%;" src="static/assets/img/css.jpg">
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title h4">
                                        Introduction to HTML & CSS
                                    </h3>
                                    <p class="card-text text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis libero et orci fringilla, eu varius neque eleifend.</p>

                                    <p class="card-text h6 mb-3">
                                        <img class="rounded-circle me-1" style="height: 24px;width: 24px;" src="static/assets/img/clock.png">2 Hours &dash; <span class="text-primary fw-bold">Programming</span>
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="detail.php" type="button" class="btn btn-sm btn-outline-secondary">View</a>

                                            <a href="bookmark.php" type="button" class="btn btn-sm btn-outline-primary">Bookmarks</a>
                                        </div>
                                        <small class="badge rounded-pill text-light bg-success p-2 h6">Free</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col gallery-item">
                            <div class="card shadow-sm border-bottom border-5">
                                <a href="detail.php" class="card-img">
                                    <img class="bd-placeholder-img card-img-top" style="height: 225px;width: 100%;" src="static/assets/img/excel.jpg">
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title h4">
                                        Microsoft Excel for Data Scientist
                                    </h3>
                                    <p class="card-text text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis libero et orci fringilla, eu varius neque eleifend.</p>

                                    <p class="card-text h6 mb-3">
                                        <img class="rounded-circle me-1" style="height: 24px;width: 24px;" src="static/assets/img/clock.png">2 Hours &dash; <span class="text-primary fw-bold">Programming</span>
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="detail.php" type="button" class="btn btn-sm btn-outline-secondary">View</a>

                                            <a href="bookmark.php" type="button" class="btn btn-sm btn-outline-primary">Bookmarks</a>
                                        </div>
                                        <small class="badge rounded-pill text-light bg-success p-2 h6">Free</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col gallery-item">
                            <div class="card shadow-sm border-bottom border-5">
                                <a href="detail.php" class="card-img">
                                    <img class="bd-placeholder-img card-img-top" style="height: 225px;width: 100%;" src="static/assets/img/db.jpg">
                                </a>
                                <div class="card-body">
                                    <h3 class="card-title h4">
                                        Introduction to SQL Database
                                    </h3>
                                    <p class="card-text text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis libero et orci fringilla, eu varius neque eleifend.</p>

                                    <p class="card-text h6 mb-3">
                                        <img class="rounded-circle me-1" style="height: 24px;width: 24px;" src="static/assets/img/clock.png">2 Hours &dash; <span class="text-primary fw-bold">Programming</span>
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="detail.php" type="button" class="btn btn-sm btn-outline-secondary">View</a>

                                            <a href="bookmark.php" type="button" class="btn btn-sm btn-outline-primary">Bookmarks</a>
                                        </div>
                                        <small class="badge rounded-pill text-light bg-danger p-2 h6">USD 25.50</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled"><a class="page-link">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm border-bottom border-5">
                        <div class="card-header bg-primary text-light">
                            <h4 class="card-title">Categories</h4>
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <h6 class="mb-0">Programming</h6>
                                    <small class="text-muted">10</small>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <h6 class="mb-0">HTML & CSS</h6>
                                    <small class="text-muted">2</small>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <h6 class="mb-0">Database</h6>
                                    <small class="text-muted">3</small>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <h6 class="mb-0">Django</h6>
                                    <small class="text-muted">4</small>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <h6 class="mb-0">Web Development</h6>
                                    <small class="text-muted">6</small>
                                </div>
                            </a>

                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <h6 class="mb-0">Microsoft Office</h6>
                                    <small class="text-muted">8</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Footer-->
        <?php 
           include("partials/footer.php")
        ?>
       
    </body>
</html>