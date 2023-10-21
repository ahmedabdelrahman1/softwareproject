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
            @include 'config.php';

            if (isset($_GET['delete_id'])) {
                $deleteId = $_GET['delete_id'];
                echo "<script>
                        window.location.href = 'delete.php?id=$deleteId';
                </script>";
            }

            $sql = "SELECT * FROM course_table"; // Replace 'user' with your table name
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["detials"] . "</td>";
                    echo "<td>" . $row["instructorID"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["sectionID"] . "</td>";
                    echo "<td><button type='button' data-bs-toggle='modal' class='delete' onclick=\"location.href='?delete_id={$row['ID']}'\"><i class='fa-solid fa-trash'></i></button></td>";
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
