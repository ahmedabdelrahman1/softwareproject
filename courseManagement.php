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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                <th>Details</th>
                <th>Instructor</th>
                <th>Price</th>
                <th>Section_ID</th>
                <th>Action</th>
            </tr>

            <?php
            include 'config.php';

            if (isset($_GET['delete_id'])) {
                $deleteId = $_GET['delete_id'];
                echo "<script>
                        window.location.href = 'delete.php?id=$deleteId';
                </script>";
            }

            $sql = "SELECT * FROM course_table"; // Replace 'course_table' with your table name
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["details"] . "</td>";
                    echo "<td>" . $row["instructorID"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["sectionID"] . "</td>";
                    echo "<td>
                            <button class='btn btn-primary edit' data-id='{$row['ID']}' data-name='{$row['name']}' data-details='{$row['details']}' data-instructor='{$row['instructorID']}' data-price='{$row['price']}' data-section='{$row['sectionID']}'>
                                Edit
                            </button>
                        </td>";
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
</body>
</html>

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
                        <label for="editDetails">Course Details</label>
                        <input type="text" class="form-control" id="editDetails" name="editDetails">
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
                        <label for="editSection">Section ID</label>
                        <input type="text" class="form-control" id="editSection" name="editSection">
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
        var details = $(this).data('details');
        var instructor = $(this).data('instructor');
        var price = $(this).data('price');
        var section = $(this).data('section');

        $('#editId').val(id);
        $('#editName').val(name);
        $('#editDetails').val(details);
        $('#editInstructor').val(instructor);
        $('#editPrice').val(price);
        $('#editSection').val(section);

        $('#editModal').modal('show');
    });

    $('#saveChanges').click(function() {
        var id = $('#editId').val();
        var name = $('#editName').val();
        var details = $('#editDetails').val();
        var instructor = $('#editInstructor').val();
        var price = $('#editPrice').val();
        var section = $('#editSection').val();

        $.ajax({
            url: 'edit.php',
            type: 'POST',
            data: {
                id: id,
                name: name,
                details: details,
                instructor: instructor,
                price: price,
                section: section
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
