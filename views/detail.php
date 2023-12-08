<!DOCTYPE html>
<html lang="en">
<?php

session_start();
include("partials/head.php");

echo '<body>';
include("partials/navbar.php");

include '../db/config.php';
require '../models/classcourse.php';

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    echo "Course ID: " . $course_id;
    $courseObject = new Course();
    $selectedCourse = $courseObject->selectByID($course_id);



?>

<!-- Page content-->




<div class="container py-5 bg-body-tertiary">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="courses.html">Courses</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Detail</li>
        </ol>
    </nav>

    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 g-3 mt-3">
        <div class="col-md-8">
            <div class="col">
                <?php echo '<div class="card shadow-sm border-bottom border-5">
    <img class="img-thumbnail" style="height: 300px;width: 100%;" src="static/assets/img/py.jpg">
    <div class="card-body bg-light">
        <h3 class="card-title h4 mb-3">
         ' . $selectedCourse->getPerview() . '
        </h3>
        
        <!-- Category -->
        <p class="card-text h6 mb-3">
            <img style="height: 24px;width: 24px;" class="rounded-circle me-1" src="static/assets/img/category.png">
            <span class="text-muted">Category:</span> ' . $selectedCourse->getCategory() . '
        </p>
        
        <!-- Instructor -->
        <p class="card-text h6 mb-3">
            <img style="height: 24px;width: 24px;" class a="rounded-circle me-1" src="static/assets/img/instructor.png">
            <span class="text-muted">Instructor:</span> Denamse Derkos
        </p>
        
        <!-- Level -->
        <p class="card-text h6 mb-3">
            <img style="height: 24px;width: 24px;" class="rounded-circle me-1" src="static/assets/img/level.png">
            <span class="text-muted">Level:</span> ' . $selectedCourse->getLevel() . '
        </p>
        
        
        <!-- Duration -->
        <p class="card-text h6 mb-3">
            <img style="height: 24px;width: 24px;" class="rounded-circle me-1" src="static/assets/img/clock.png">
            <span class="text-muted">Start Date:</span> ' . $selectedCourse->getStartdate() . '
        </p>

        <p class="card-text h6 mb-3">
        <img style="height: 24px;width: 24px;" class="rounded-circle me-1" src="static/assets/img/clock.png">
        <span class="text-muted">End Date:</span> ' . $selectedCourse->getEnddate() . '
        </p>
        
        <div class="d-flex justify-content-between align-items-center">
            <!-- Price -->
            <small class="badge rounded-pill text-light bg-success p-2 h6">' . $selectedCourse->getPrice() . '</small>
            
            <div class="btn-group">
                <!-- Bookmarks Button -->
                <a href="bookmarks.html" type="button" class="btn btn-sm btn-outline-primary">Bookmarks</a>
                <a href="" class="btn btn-sm btn-outline-primary">Enrollment</a>
            </div>
        </div>
    </div>
    
    <!-- Course Description -->
    <div class="card-body">
        <h5 class="card-title">What You will learn in this course</h5>
        <p class="card-text text-muted">' . $selectedCourse->getCourseinfo() . '</p>
    </div>
</div>';
 } ?>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-bottom border-5">
                <div class="card-header bg-primary text-light">
                    <h4 class="card-title">Lessons</h4>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <h6 class="mb-0">Python - Overview</h6>
                    </a>

                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <h6 class="mb-0">Python - Installing</h6>
                    </a>

                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <h6 class="mb-0">Python Syntax</h6>
                    </a>

                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <h6 class="mb-0">Python - Variables</h6>
                    </a>

                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <h6 class="mb-0">Python - Data Types</h6>
                    </a>

                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <h6 class="mb-0">Python - User Input</h6>
                    </a>

                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <h6 class="mb-0">Python - Statements</h6>
                    </a>

                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <h6 class="mb-0">Python - Collections</h6>
                    </a>

                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <h6 class="mb-0">Python - Loops</h6>
                    </a>

                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <h6 class="mb-0">Python - Functions</h6>
                    </a>
                </div>
            </div>

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