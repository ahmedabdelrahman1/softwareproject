<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
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
            margin-right: 10px;
            /* Adjust the margin as needed */
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
                    <th>Category</th>
                    <th>level</th>
                    <th>startdate</th>
                    <th>enddate</th>
                    <th>courseinfo</th>
                    <th>Action</th>
                </tr>

                <?php


                // include("adminlayout.php");
                include '../db/config.php';
                session_start();
                require '../models/classcourse.php';

                $courseObject = new Course();
                $courseObject->fetchCourses();


                //  if ($courses->num_rows > 0) {
                foreach ($courseObject->getCourses() as $course) {
                    echo "<tr>";
                    echo "<td>" . $course->getId() . "</td>";
                    echo "<td>" . $course->getName() . "</td>";
                    echo "<td>" . $course->getPerview() . "</td>";
                    echo "<td>" . $course->getInstructor() . "</td>";
                    echo "<td>" . $course->getPrice() . "</td>";
                    echo "<td>" . $course->getCategory() . "</td>";
                    echo "<td>" . $course->getLevel() . "</td>";
                    if ($course->getStartdate() != '0000-00-00') {
                        $formattedStartDate = date('Y-m-d', strtotime($course->getStartdate()));
                        echo "<td>" . $formattedStartDate . "</td>";
                    } else {
                        echo "<td>Not available</td>";
                    }

                    // Check if the enddate is not '0000-00-00'
                    if ($course->getEnddate() != '0000-00-00') {
                        $formattedEndDate = date('Y-m-d', strtotime($course->getEnddate()));
                        echo "<td>" . $formattedEndDate . "</td>";
                    } else {
                        echo "<td>Not available</td>";
                    }
                    echo "<td>" . $course->getCourseinfo() . "</td>";
                    echo '<td>
            <div class="button-container">
                <button class="btn btn-primary edit" data-toggle="modal" data-target="#editModal' . $course->getId() . '" type="button">
    <i class="fas fa-edit"></i> <!-- Assuming you are using Font Awesome for icons -->
</button>
            </div>
            <div class="modal fade" id="editModal' . $course->getId() . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="post" action="../course_controller.php">

                        <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="course_id" value="' . $course->getId() . '">
                            <div class="form-group">
                                <label for="editName">Course Name</label>
                                <input type="text" class="form-control" id="editName" name="editName" value="' . $course->getName() . '">
                            </div>
                    <div class="form-group">
                        <label for="editpreview">Course preview</label>
                        <input type="text" class="form-control" id="editpreview" name="editpreview" value="' . $course->getPerview() . '">
                    </div>
                    <div class="form-group">
                        <label for="editInstructor">Instructor</label>
                        <input type="text" class="form-control" id="editInstructor" name="editInstructor" value="' . $course->getInstructor() . '">
                    </div>
                    <div class="form-group">
                        <label for="editPrice">Price</label>
                        <input type="text" class="form-control" id="editPrice" name="editPrice" value="' . $course->getPrice() . '">
                    </div>
                    <div class="form-group">
                        <label for="editCategory">Category</label>
                        <input type="text" class="form-control" id="editCategory" name="editCategory" value="' . $course->getCategory() . '">
                    </div>
                    <div class="form-group">
                        <label for="editLevel">Level</label>
                        <input type="text" class="form-control" id="editLevel" name="editLevel" value="' . $course->getLevel() . '">
                    </div>
                    <div class="form-group">
                        <label for="startDuration">Start Duration</label>
                        <input type="date" class="form-control" id="editstart" name="editstart" value="' . $course->getStartdate() . '">
                    </div>
                    <div class="form-group">
                        <label for="EndDuration">End Duration</label>
                        <input type="date" class="form-control" id="editend" name="editend" value="' . $course->getEnddate() . '">
                    </div>
                    <div class="form-group">
                        <label for="editCourseInfo">Course Info</label>
                        <textarea type="text" class="form-control" id="editCourseInfo" name="editCourseInfo" >' . $course->getCourseinfo() . '</textarea>
                    </div>  

                    <!-- Requirements Section -->
                    <div class="form-group">
                        <h4>Requirements</h4>'; ?>

                <?php
                    // Assuming $requirements is an array containing existing requirements for the course
                   $requirements = $course->getRequirementsByCourseID($course->getId());
                    foreach ($requirements as $req) {
                        echo '<div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="checkbox" class="form-check-input" name="selectedRequirements[]" value="' . $req->getreq_id() . '" >
                    <i class="fas fa-trash text-danger delete-requirement" data-toggle="checkbox"></i>
                </div>
            </div>
            <input type="text" class="form-control" name="existingRequirements[]" value="' . $req->getreq() . '" readonly>
            <input type="text" class="form-control" name="existingValues[]" value="' . $req->getReqValue() . '" readonly>
          </div>';
                    }
                   echo '<button onclick="addRequirement(' . $course->getId() . ')" type="button" class="btn btn-secondary" id="addRequirementBtn_' . $course->getId() . '">Add Requirement</button>
                  <div id="dynamicRequirementsContent_' . $course->getId() . '"></div>';
                    echo ' 
               </div>
           </div>
       
           <button type="submit" class="btn btn-primary" id="submitButton1">Submit</button>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
            <form method="POST" action="../controller/course_controller.php">
            <input type="hidden" name="action" value="delete">
                <input type="hidden" name="course_id" value="' . $course->getId() . '">
                <button class="btn btn-danger delete" type="submit">
                    <i class="fas fa-trash"></i>
                </button>
            </form>';
                    echo '</td></tr>';
                }
                // }
                $conn->close();
                ?>

            </table>
        </div>
    </div>


    <!--create-->
    <button class="btn btn-primary create" data-toggle="modal" data-target="#createModal">
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
                    <form id="createForm" method="post" action="../controller/course_controller.php">

                        <input type="hidden" name="action" value="create">

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
                            <label for="createCategory">Category</label>
                            <input type="text" class="form-control" id="createCategory" name="createCategory">
                        </div>
                        <div class="form-group">
                            <label for="createLevel">Level</label>
                            <input type="text" class="form-control" id="createLevel" name="createLevel">
                        </div>
                        <div class="form-group">
                            <label for="startDuration">Start Duration</label>
                            <input type="date" class="form-control" id="start" name="start">
                        </div>
                        <div class="form-group">
                            <label for="endDuration">End Duration</label>
                            <input type="date" class="form-control" id="end" name="end">
                        </div>
                        <div class="form-group">
                            <label for="createCourseInfo">Course Info</label>
                            <textarea type="text" class="form-control" id="createCourseInfo" name="createCourseInfo"></textarea>
                        </div>
                        <div class="form-group">
                            <?php
                            echo '<button onclick="addRequirement(' . "" . ')" type="button" class="btn btn-secondary" id="addRequirementBtn_' . $course->getId() . '">Add Requirement</button>
                               <div id="dynamicRequirementsContent_' . "" . '"></div>';
                            ?>
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

    <script>
    document.getElementById('editForm').addEventListener('submit', function (event) {
        // Log a message to the console
        console.log('Submit button clicked!');

        // Uncomment the following line after adding your logic
        // this.submit();
    });
</script>



    




</body>

</html>