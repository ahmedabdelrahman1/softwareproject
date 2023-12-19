<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Form Title</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
   
</head>
<body>
<?php
@include '../db/config.php';
@include '../models/classUser.php';
@include '../models/usertypesclass.php';
@include '../models/pageclass.php';
session_start();
?>
<div class="container mt-5">
    <h3>Page permission</h3>
    <form action="../controller/permission_controller.php" method="post">
    <input type="hidden" name="action" value="permission">
        <div class="row">
            <div class="col-md-4">
                <label for="leftValues">All Pages</label>
                <select id="leftValues" class="form-control" size="5" multiple>
                    <?php
                    
                    $objectpage = new pages();
                    $pages=$objectpage->getallpages();
                    foreach ($pages as $page) {
                        echo '<option value="'.$page['ID'].'">'.$page['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-1 text-center">
                <button type="button" id="btnLeft" class="btn btn-secondary mt-2">&lt;&lt;</button>
                <button type="button" id="btnRight" class="btn btn-secondary mt-2">&gt;&gt;</button>
            </div>
            <div class="col-md-4">
                <label for="rightValues">Choosen Pages</label>
                <select id="rightValues" name="choosen-pages[]" class="form-control" size="5" multiple></select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-2">
                <label for="UserType">Choose User Type:</label>
                <select name="UserType" class="form-control">
                    <?php
                    
                    $objectusertypes= new usertype();
                    $userTypes=$objectusertypes->getallusertypes();
                    foreach ($userTypes as $userType) {
                        echo '<option value="'.$userType['ID'].'">'.$userType['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-2">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
        </div>
    </form>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap JavaScript components) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
