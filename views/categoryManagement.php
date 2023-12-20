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
    <h1 class="mt-4">Category Management</h1>
    <div class="card-header">
        Category Data
    </div>
    <div class="card-body">
        <form method="POST" action="adminlayout.php">
            <div class="form-group">
                <label for="categoryName">Category Name:</label>
                <input type="text" class="form-control" id="categoryName" name="categoryName" required>
            </div>
            <button type="submit" class="btn btn-primary" name="create_button"><i class="fa-solid fa-plus"></i> Create</button>
        </form>
        <hr>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
    
            <?php
            @include '../db/config.php';
            @include '../models/classCategory.php';
            session_start();

            $obj = new Category(null,null);

            // Handle category creation
            if (isset($_POST['create_button'])) {
                $categoryName = $_POST['categoryName'];
                $obj->addCategory($categoryName);
            }

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['delete_btn'])) {
                $deleteId = $_POST['delete_id'];

                $obj->deleteByID($deleteId);
            }

            $sql = "SELECT * FROM category"; 
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>
                        <form method='POST' action='adminlayout.php'> <!-- Replace 'your_script.php' with the actual filename -->
                            <input type='hidden' name='delete_id' value='{$row['id']}' />
                            <button type='submit' class='btn btn-danger' name='delete_btn_{$row['id']}'><i class='fa-solid fa-trash'></i> Delete</button>
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
