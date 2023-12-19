<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin panel</title>
  <link rel="icon" type="image/x-icon" href="../public/assets/section.jpg" />

  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/css/styleA.css" type="text/css">
  <link href="../public/css/admin-styles.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> -->
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
  <?php

  @include '../db/config.php';
  @include '../models/classUser.php';

  session_start();



  if (isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];

    User::deleteUser($deleteId);
    User::deleteImageByID($deleteId);

    // // Perform the SQL DELETE operation
    // $sql = "DELETE FROM user WHERE id = $deleteId";
    // if ($conn->query($sql) === TRUE) {
    //   echo "Record deleted successfully.";
    // } else {
    //   echo "Error deleting record: " . $conn->error;
    // }
  }

  ?>
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/admin">Admin Panel</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <!-- <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
      </div> -->
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <!-- <li><a class="dropdown-item" href="#!">Settings</a></li>
          <li><a class="dropdown-item" href="#!">Activity Log</a></li> -->
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li>

            <button class="btn btn-danger" style="margin-left:35px" onclick="location.href='SIGNOUT.php'">Sign-out</button>


          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>


            <a class="nav-link" href="adminlayout.php" onclick="loadDashboard()">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Manage</div>




            <a class="nav-link" href="javascript:void(0);" onclick="loadUserManagement()">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
              Users
            </a>
            <a class="nav-link" href="javascript:void(0);" onclick="loadCourseManagement()">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
              Courses
            </a>
            <a class="nav-link" href="javascript:void(0);" onclick="">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
            Attendence
            </a>
            <a class="nav-link" href="javascript:void(0);" onclick="loadchat">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
              Messages
            </a>
            <a class="nav-link" href="javascript:void(0);" onclick="">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
            Quizes
            </a>

          </div>
        </div>
        <div class="sb-sidenav-footer">
          <!-- <div class="small">Logged in as: <?php $_SESSION['fname'] ?></div> -->
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div id="content-container">
          <!-- Content from UserManagement.php will be loaded here -->
          <?php
          include("adminIndex.php");
          ?>
        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Section 2023</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>



  <script>
    function loadDashboard() {
      // Use AJAX to load UserManagement.php into the content-container div
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("content-container").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "adminIndex.php", true);
      xhttp.send();
    }
  </script>


  <script>
    function loadUserManagement() {
      // Use AJAX to load UserManagement.php into the content-container div
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("content-container").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "UserManagement.php", true);
      xhttp.send();
    }
  </script>



  <script>
    function loadCourseManagement() {
      // Use AJAX to load UserManagement.php into the content-container div
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("content-container").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "courseManagement.php", true);
      xhttp.send();
    }
  </script>
   <script>
        let count = 1;

        function addRequirement(courseId="") {
    console.log('Button clicked!');
    count += 1;

    let container = document.getElementById('dynamicRequirementsContent_' + courseId);

    let div = document.createElement('div');
    div.className = 'mb-3';

    let labelName = document.createElement('label');
    labelName.htmlFor = 'requirementName' + count;
    labelName.textContent = 'Requirement Name';

    let inputName = document.createElement('input');
    inputName.type = 'text';
    inputName.className = 'form-control';
    inputName.id = 'requirementName' + count + '_' + courseId;
    inputName.name = 'newRequirementName' + count + '_' + courseId;

    let labelValue = document.createElement('label');
    labelValue.htmlFor = 'requirementValue' + count;
    labelValue.textContent = 'Requirement Value';

    let inputValue = document.createElement('input');
    inputValue.type = 'text';
    inputValue.className = 'form-control';
    inputValue.id = 'requirementValue' + count + '_' + courseId;
    inputValue.name = 'newRequirementValue' + count + '_' + courseId;

    div.appendChild(labelName);
    div.appendChild(inputName);
    container.appendChild(div);

    div = document.createElement('div');
    div.className = 'mb-3';
    div.appendChild(labelValue);
    div.appendChild(inputValue);
    container.appendChild(div);
}

    </script>
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
                        data: {
                            course_id: courseId
                        },
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

   
    
  <script src="../public/js/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../public/js/admin-scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/vanilla-datatables-exportable@latest/datatable