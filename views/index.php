<!DOCTYPE html>
<html lang="en">
<?php   
            session_start();
            include("partials/head.php");
           
    echo'<body>';
            include("partials/navbar.php");
    ?>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <!-- Page heading-->
                            <h1 class="mb-3">Welcome to Section Engineering Services!</h1> 
                            <p class="lead fw-normal mb-5">A better place to start building yourself.</p>

                            <div class="col-auto">
                                <a href="courses.php" class="btn btn-primary btn-lg" type="submit">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Icons Grid-->
        <section class="features-icons bg-light text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-lightbulb m-auto text-primary"></i></div>
                            <h3>Enriching Education</h3>
                            <p class="lead fw-normal text-muted mb-0">Sevenges empowers with enriching education.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-clock m-auto text-primary"></i></div>
                            <h3>Learn Anytime</h3>
                            <p class="lead fw-normal text-muted mb-0">Learn anytime, anywhere, at your pace with Sevenges.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-key m-auto text-primary"></i></div>
                            <h3>Unlock Your Potential</h3>
                            <p class="lead fw-normal text-muted mb-0">Sevenges is your key to unlocking your full potential.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Image Showcases-->
        <section class="showcase">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('../public/assets/img/bg-showcase-1.jpg')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>Empowering Minds, Enriching Lives</h2>
                        <p class="lead fw-normal text-muted mb-0">Our e-learning platform, Sevenges, is committed to empowering individuals by providing high-quality educational content that enriches their lives. We believe in the transformative power of knowledge.</p>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 text-white showcase-img" style="background-image: url('../public/assets/img/bg-showcase-2.jpg')"></div>
                    <div class="col-lg-6 my-auto showcase-text">
                        <h2>Learn Anytime, Anywhere, at Your Pace</h2>
                        <p class="lead fw-normal text-muted mb-0">Sevenges offers flexibility and accessibility, allowing learners to study at their own pace, on their own terms. Whether it's day or night, from home or on the go, education is just a click away.</p>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('../public/assets/img/bg-showcase-3.jpg')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>Unlock Your Potential with Sevenges</h2>
                        <p class="lead fw-normal text-muted mb-0">Sevenges is your key to unlocking your full potential. Our diverse courses and supportive community are designed to help you achieve your goals and reach new heights in your personal and professional life.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonials-->
        <section class="testimonials text-center bg-light">
            <div class="container">
                <h2 class="mb-5">What people are saying...</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="../public/assets/img/testimonials-1.jpg" alt="..." />
                            <h5>Margaret E.</h5>
                            <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="../public/assets/img/testimonials-2.jpg" alt="..." />
                            <h5>Fred S.</h5>
                            <p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="../public/assets/img/testimonials-3.jpg" alt="..." />
                            <h5>Sarah W.</h5>
                            <p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Call to Action-->
        <section class="call-to-action text-white text-center" id="signup">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <h2 class="mb-5">
                            Ready to get started?
                        </h2>
                        <div class="col-auto">
                            <a href="courses.php" class="btn btn-primary btn-lg" type="submit">Explore Our Courses!</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="courses">
    <?php
    // Example course data (replace this with your actual course data)
    $courses = [
        ['id' => 1, 'name' => 'Course 1', 'description' => 'Description of Course 1'],
        ['id' => 2, 'name' => 'Course 2', 'description' => 'Description of Course 2'],
        // Add more courses as needed
    ];

    // Loop through courses and display them
    foreach ($courses as $course) {
        echo '<div class="course">';
        echo '<h3>' . $course['name'] . '</h3>';
        echo '<p>' . $course['description'] . '</p>';
        
        // Enrollment button with data attributes
        echo '<button class="enroll-btn" data-course-id="' . $course['id'] . '">Enroll</button>';
        
        echo '</div>';
    }
    ?>
</section>

<!-- Other HTML content on your page -->

<!-- Add your AJAX enrollment logic here -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const enrollButtons = document.querySelectorAll('.enroll-btn');

        enrollButtons.forEach(button => {
            button.addEventListener('click', function () {
                const courseId = this.getAttribute('data-course-id');
                enrollStudent(courseId);
            });
        });

        function enrollStudent(courseId) {
            // Implement your AJAX logic here
            // Example using Fetch API:
            fetch('student_controller.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=enroll&courseId=' + encodeURIComponent(courseId),
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response data
                if (data.success) {
                    alert('Enrollment successful!');
                } else {
                    alert('Enrollment failed. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Enrollment failed due to an error. Please try again later.');
            });
        }
    });
</script>
        <!-- Footer-->
        <?php 
            include("partials/footer.php")
        ?>
    </body>
</html>
