<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include("partials/head.php");

echo '<body>';
include("partials/navbar.php");
?>
<!-- Page content-->
<div class="container-fluid py-5 bg-body-tertiary">
    <div class="col-lg-6 mx-auto">
        <form class="form-group">
            <!-- <div class="row"> -->
            <!-- <div class="col"> -->
            <input class="form-control form-control" type="search" placeholder="Search for courses..." />
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

    <div d="gallery" class="row row-cols-1 row-cols-sm-1 row-cols-md-2 g-3 gallery">
        <div class="col-md-9">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-5">
                <?php
                $courseObject = new Course();
                $courseObject->fetchCourses();


                //  if ($courses->num_rows > 0) {
                foreach ($courseObject->getCourses() as $course) {
                    echo '<div class="col gallery-item">';
                    echo '    <div class="card shadow-sm border-bottom border-5">';
                    echo '        <a href="coursecontent.php?course_id=' . $course->getId() . '" class="card-img">';
                    echo '            <img class="bd-placeholder-img card-img-top" style="height: 225px;width: 100%;" src="../public/assets/img/course-default.png">';
                    echo '        </a>';
                    echo '        <div class="card-body">';
                    echo '            <h3 class="card-title h4">';
                    echo '                Introduction to ' .  $course->getName();
                    echo '            </h3>';
                    echo '            <p class="card-text text-muted">' . $course->getPerview() . '</p>';
                    echo '';
                    echo '            <p class="card-text h6 mb-3">';
                    echo '                <img class="rounded-circle me-1" style="height: 24px;width: 24px;" src="../public/assets/img/clock.png">2 Hours &dash; <span class="text-primary fw-bold">Programming</span>';
                    echo '            </p>';
                    echo '';
                    echo '            <div class="d-flex justify-content-between align-items-center">';
                    echo '                <div class="btn-group">';
                    echo '                    <a href="detail.php?course_id=' . $course->getId() . '" type="button" class="btn btn-sm btn-outline-secondary">View</a>';
                    echo '                    <a href="bookmark.php" type="button" class="btn btn-sm btn-outline-primary">Bookmarks</a>';
                    echo '                </div>';
                    echo '            </div>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }

                ?>


                <?php
                // Assuming you have already included necessary files and started the session
                @include '../db/config.php';
                @include '../models/classCategory.php';
                // Instantiate Category class
                $categoryObj = new Category(null, null);

                // Fetch all categories from the database
                $categories = $categoryObj->getAllCategories();

                ?>
                <div class="col-md-3">
                    <div class="card shadow-sm border-bottom border-5">
                        <div class="card-header bg-primary text-light">
                            <h4 class="card-title">Categories</h4>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php
                            // Iterate through categories and generate HTML
                            foreach ($categories as $category) {
                                echo '<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">';
                                echo '<div class="d-flex gap-2 w-100 justify-content-between">';
                                echo '<h6 class="mb-0">' . htmlspecialchars($category['name']) . '</h6>';
                                // You might want to replace this with the actual count of items in each category
                                echo '</div>';
                                echo '</a>';
                            }
                            ?>
                        </div>
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