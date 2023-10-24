<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .button-container {
        display: flex;
        align-items: center;
    }

    .button-container .btn {
        margin-right: 10px; /* Adjust the margin as needed */
    }
</style>

</head>
<body>
<div class="container-fluid px-4">
    <h1 class="mt-4">Course Management</h1>
    <div class="card-header">
        Course Data
    </div>
    <div class="card-body">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>preview</th>
                <th>Instructor</th>
                <th>Price</th>
                <th>detailsID</th>
                <th>Action</th>
            </tr>

            <?php
            include 'config.php';
           
            $sql = "SELECT * FROM course_table"; // Replace 'course_table' with your table name
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["preview"] . "</td>";
                    echo "<td>" . $row["instructorID"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["detailsID"] . "</td>";
                    echo '<td>
                    <div class="button-container">
                        <button class="btn btn-primary edit" data-toggle="modal" data-target="#editModal" data-id="' . $row['ID'] . '" data-name="' . $row['name'] . '" data-preview="' . $row['preview'] . '" data-instructor="' . $row['instructorID'] . '" data-price="' . $row['price'] . '" data-details="' . $row['detailsID'] . '">
                            Edit
                        </button>
                        
                        <form method="POST" action="adminIndex.php">
                            <input type="hidden" name="course_id" value="' . $row['ID'] . '">
                            <button class="btn btn-danger delete" type="submit">
                                <i class="fas fa-trash"></i> <!-- Trash can icon -->
                            </button>
                        </form>
                    </div>
                </td>';
                    echo "</tr>";
                }
            
            } else {
                echo "No records found.";
            }

            $conn->close();
            ?>
        </table>
    </div>
</div>
<!-- Edit Course Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="editId" name="editId">
                    <div class="form-group">
                        <label for="editName">Course Name</label>
                        <input type="text" class="form-control" id="editName" name="editName">
                    </div>
                    <div class="form-group">
                        <label for="editpreview">Course preview</label>
                        <input type="text" class="form-control" id="editpreview" name="editpreview">
                    </div>
                    <div class="form-group">
                        <label for="editInstructor">Instructor</label>
                        <input type="text" class="form-control" id="editInstructor" name="editInstructor">
                    </div>
                    <div class="form-group">
                        <label for="editPrice">Price</label>
                        <input type="text" class="form-control" id="editPrice" name="editPrice">
                    </div>
                    <div class="form-group">
                        <label for="editdetailsID">details ID</label>
                        <input type="text" class="form-control" id="editdetailsID" name="editdetailsID">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChanges">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('.edit').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var preview = $(this).data('preview');
        var instructor = $(this).data('instructor');
        var price = $(this).data('price');
        var detailsID = $(this).data('detailsID');

        $('#editId').val(id);
        $('#editName').val(name);
        $('#editpreview').val(preview);
        $('#editInstructor').val(instructor);
        $('#editPrice').val(price);
        $('#editdetailsID').val(detailsID);

        $('#editModal').modal('show');
    });

    $('#saveChanges').click(function() {
        var id = $('#editId').val();
        var name = $('#editName').val();
        var details = $('#editpreview').val();
        var instructor = $('#editInstructor').val();
        var price = $('#editPrice').val();
        var detailsID = $('#editdetailsID').val();

        $.ajax({
            url: 'edit.php',
            type: 'POST',
            data: {
                id: id,
                name: name,
                preview: preview,
                instructor: instructor,
                price: price,
                detailsID: detailsID
            },
            success: function(response) {
                if (response == 'success') {
                    $('#editModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error updating course.');
                }
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    // Delete button click event
    $('.delete').click(function() {
        var courseId = $(this).data('id');
        var courseName = $(this).data('name');
        var detailsID = $(this).data('detailsID');

        // Display a confirmation dialog
        if (confirm('Are you sure you want to delete course: ' + courseName + '?')) {
            // Send an AJAX request to delete the course
            $.ajax({
                url: 'delete_course.php', // Replace with the URL to your delete course PHP script
                type: 'POST',
                data: { course_id: courseId },
                success: function(response) {
                    if (response == 'success') {
                        // Reload the page or handle the success as needed
                        location.reload();
                    } else {
                        alert('Failed to delete course.');
                    }
                }
            });
        }
    });
});
</script>



</body>
</html>

