<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Section - Courses </title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="static/assets/section.ico" />
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
            include("navbar.php");
            session_start();
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
                    require './classcourse.php';
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
    </body>
</html>