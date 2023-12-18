<?php

@include 'config.php';
@include '../models/classUser.php';

$userObject = new User();
$userObject->sign_out();


?>