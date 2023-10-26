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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
session_start();
require './classcourse.php';
require './classdetails.php';

$sql = "SELECT * FROM course_table"; // Replace 'course_table' with your table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row2 = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row2["ID"] . "</td>";
        echo "<td>" . $row2["name"] . "</td>";
        echo "<td>" . $row2["preview"] . "</td>";
        echo "<td>" . $row2["instructorID"] . "</td>";
        echo "<td>" . $row2["price"] . "</td>";
        echo "<td>" . $row2["detailsID"] . "</td>";
        echo '<td>
            <div class="button-container">
                <button class="btn btn-primary edit" data-toggle="modal" data-target="#editModal' . $row2['ID'] . '" type="button">
                    Edit
                </button>
            </div>
            <div class="modal fade" id="editModal' . $row2['ID'] . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="post" action="edit.php">
                            <input type="hidden" name="course_id" value="' . $row2['ID'] . '">
                            <div class="form-group">
                                <label for="editName">Course Name</label>
                                <input type="text" class="form-control" id="editName" name="editName" value="' . $row2["name"] . '">
                            </div>
                    <div class="form-group">
                        <label for="editpreview">Course preview</label>
                        <input type="text" class="form-control" id="editpreview" name="editpreview" value="'.$row2["preview"] .'">
                    </div>
                    <div class="form-group">
                        <label for="editInstructor">Instructor</label>
                        <input type="text" class="form-control" id="editInstructor" name="editInstructor" value="'.$row2["instructorID"] .'">
                    </div>
                    <div class="form-group">
                        <label for="editPrice">Price</label>
                        <input type="text" class="form-control" id="editPrice" name="editPrice" value="'.$row2["price"] .'">
                    </div>
                    <div class="form-group">
                        <label for="editdetailsID">details ID</label>
                        <input type="text" class="form-control" id="editdetailsID" name="editdetailsID" value="'.$row2["detailsID"] .'">
                    </div>
                    <div class="form-group">
        <label for="editCategory">Category</label>
        <input type="text" class="form-control" id="editCategory" name="editCategory">
    </div>
    <div class="form-group">
        <label for="editLevel">Level</label>
        <input type="text" class="form-control" id="editLevel" name="editLevel">
    </div>
    <div class="form-group">
        <label for="editDuration">Duration</label>
        <input type="text" class="form-control" id="editDuration" name="editDuration">
    </div>
    <div class="form-group">
        <label for="editCourseInfo">Course Info</label>
        <textarea type="text" class="form-control" id="editCourseInfo" name="editCourseInfo"></textarea>
    </div>  
    <button type="submit" class="btn btn-primary" >Save Changes</button>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
            <form method="POST" action="adminlayout.php">
                <input type="hidden" name="course_id" value="' . $row2['ID'] . '">
                <button class="btn btn-danger delete" type="submit">
                    <i class="fas fa-trash"></i>
                </button>
            </form>';
        echo '</td></tr>';
    }
}
 



$conn->close();
?>
              

            $conn->close();
            ?>
        </table>
    </div>
</div>


<!--create-->
<button class="btn btn-primary create" data-toggle="modal" data-target="#createModal" >
                            Create
                        </button>

                        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="createForm" method="post" action="addcourse.php" >
    <input type="hidden" id="createId" name="createId">
    <div class="form-group">
        <label for="createName">Course Name</label>
        <input type="text" class="form-control" id="createName" name="createName">
    </div>
    <div class="form-group">
        <label for="createpreview">Course Preview</label>
        <input type="text" class="form-control" id="createpreview" name="createpreview">
    </div>
    <div class="form-group">
                        <label for="createInstructor">Instructor</label>
                        <input type="text" class="form-control" id="createInstructor" name="createInstructor">
                    </div>
    <div class="form-group">
        <label for="createPrice">Price</label>
        <input type="text" class="form-control" id="createPrice" name="createPrice">
    </div>
    <div class="form-group">
        <label for="createdetailsID">Details ID</label>
        <input type="text" class="form-control" id="createdetailsID" name="createdetailsID">
    </div>
    <div class="form-group">
        <label for="createCategory">Category</label>
        <input type="text" class="form-control" id="createCategory" name="createCategory">
    </div>
    <div class="form-group">
        <label for="createLevel">Level</label>
        <input type="text" class="form-control" id="createLevel" name="createLevel">
    </div>
    <div class="form-group">
        <label for="createDuration">Duration</label>
        <input type="text" class="form-control" id="createDuration" name="createDuration">
    </div>
    <div class="form-group">
        <label for="createCourseInfo">Course Info</label>
        <textarea type="text" class="form-control" id="createCourseInfo" name="createCourseInfo"></textarea>
    </div>  
     <button type="submit" class="btn btn-primary" id="saveChanges">Save Changes</button>
</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             
            </div>
        </div>
    </div>
</div>

    

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('.create').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var preview = $(this).data('preview');
        var instructor = $(this).data('instructor');
        var price = $(this).data('price');
        var detailsID = $(this).data('detailsID');

        $('#createId').val(id);
        $('#createName').val(name);
        $('#createpreview').val(preview);
        $('#createInstructor').val(instructor);
        $('#createPrice').val(price);
        $('#createdetailsID').val(detailsID);

        $('#createModal').modal('show');
    });

    
       
});
</script>

<!-- Edit Course Modal -->


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

