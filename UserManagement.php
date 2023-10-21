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
    <h1 class="mt-4">User Management</h1>
    <div class="card-header">
        User Data
    </div>
    <div class="card-body">
        <table>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
    
            <?php
            @include 'config.php';

            if (isset($_POST['delete_id'])) {
                $deleteId = $_POST['delete_id'];

                // Perform the SQL DELETE operation
                $sql = "DELETE FROM user WHERE id = $deleteId";
                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully.";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }

            $sql = "SELECT * FROM user"; // Replace 'user' with your table name
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["fname"] . "</td>";
                    echo "<td>" . $row["lname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["type"] . "</td>";
                    echo "<td>
                            <form method='POST'>
                                <input type='hidden' name='delete_id' value='{$row['id']}' />
                                <button type='submit' class='btn btn-danger' name='delete_button'><i class='fa-solid fa-trash'></i> Delete</button>
                            </form>
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
