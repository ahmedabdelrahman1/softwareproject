<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <?php
            // include_once 'adminlayout.php';
            // session_start();
            // Database connection code (similar to previous examples)
            
            @include 'config.php';
            require '../models/classcourse.php';

            // Query to fetch data (replace with your actual query)
            $sql = "SELECT COUNT(*) as total_users FROM user";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $userCount = $row['total_users'];
            } else {
                $userCount = 0;
            }

            $sql2 = "SELECT COUNT(*) as total_courses FROM course_table";
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
                $row2 = $result2->fetch_assoc();
                $courseCount = $row2['total_courses'];
            } else {
                $courseCount = 0;
            }

            $orderStatusCount = [10, 5, 100]; // Replace with your actual data

            $conn->close();
            ?>

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        Total Users
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h3><?php echo $userCount; ?></h3>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        Total Courses
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h3><?php echo $courseCount; ?></h3>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <!-- Repeat this block for other cards -->
        </div>
        
        <div class="row">
            <!-- Add content for other elements, e.g., charts, as needed -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/assets/diagram/graph.js"></script>


</body>
</html>
