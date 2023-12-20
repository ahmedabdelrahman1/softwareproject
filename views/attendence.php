<!DOCTYPE html>
<html lang="en">


 <?php
    session_start();
    include("partials/head.php");
   

    echo '<body>';
    include("partials/navbar.php");
    ?>

    <div class="container mt-5">
        <h1 class="mb-4">Attendance System</h1>
        <form id="attendanceForm">
            <table class="table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Status</th>
                        <th>Mark Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Assuming $students is an array containing student information (replace it with your actual data)
                    $students = array(
                        array("id" => 1, "name" => "John Doe"),
                        array("id" => 2, "name" => "Jane Doe"),
                        // Add more students as needed
                    );

                    foreach ($students as $student) {
                        echo '<tr>';
                        echo '<td>' . $student['id'] . '</td>';
                        echo '<td>' . $student['name'] . '</td>';
                        echo '<td><input type="checkbox" name="attendance[]" value="' . $student['id'] . '"></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary" onclick="markAttendance()">Submit Attendance</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js (if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Your custom JavaScript -->
    <script>
        function markAttendance() {
            // Get values from the checkboxes
            var checkboxes = document.getElementsByName('attendance');
            var selectedStudentIDs = [];

            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    selectedStudentIDs.push(checkbox.value);
                }
            });

            // Now you have an array of selected student IDs (selectedStudentIDs)
            // You can perform further actions or send this data to the server using AJAX
            console.log(selectedStudentIDs);
        }
    </script>

    <?php
    include("partials/footer.php")
    ?>
</body>

</html>
