<?php
@include '../models/usertypesclass.php';
if(isset($_SESSION['user_id'])) {
    ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-gradient static-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.php">
                    <img class="logo" src="../public/assets/section.jpg">Section
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-primary fw-bold" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                            <?php
                            $objectpages=new usertype();
                            $usertypeid=$objectpages->getusertypeidbyname($_SESSION['type']);
                            $objectpages->selectbyusertype($usertypeid[0]['ID']);
                            $pages=$objectpages->getArraypages();
                             echo "<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown'>";
                             foreach ($pages as $page){
                             echo    ' <li><a class="dropdown-item" href="'.$page['linkaddress'].'">'.$page['name'].'</a></li>';
                             }
                             echo      "<li><a class='dropdown-item text-danger' href='SIGNOUT.php'>Sign-out</a></li>";
                                  
                             echo  "</ul>";
                            /*
                           $current_page = $_SERVER['PHP_SELF'];
                            if($current_page == "/projexct2/courses.php"){
                           echo "<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown'>";
                           echo    " <li><a class='dropdown-item' href='profile.php'>Profile</a></li>";
                           echo      "<li><a class='dropdown-item' href='bookmark.php'>Bookmarks</a></li>";
                           echo     " <li><a class='dropdown-item' href='#'>Change Password</a></li> ";
                           echo     " <li><hr class='dropdown-divider' /></li>";
                           echo      "<li><a class='dropdown-item text-danger' href='SIGNOUT.php'>Sign-out</a></li>";
                                
                           echo  "</ul>";
                            }

                           else if($current_page == "/projexct2/profile.php"){
                           echo "<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown'>";
                           echo    " <li><a class='dropdown-item' href='courses.php'>courses</a></li>";
                           echo      "<li><a class='dropdown-item' href='bookmark.php'>Bookmarks</a></li>";
                           echo     " <li><a class='dropdown-item' href='#'>Change Password</a></li> ";
                           echo     " <li><hr class='dropdown-divider' /></li>";
                           echo      "<li><a class='dropdown-item text-danger' href='SIGNOUT.php'>Sign-out</a></li>";
                                
                           echo  "</ul>";
                           }

                           else if($current_page == "/projexct2/bookmark.php"){
                            echo "<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown'>";
                            echo    " <li><a class='dropdown-item' href='courses.php'>courses</a></li>";
                            echo      "<li><a class='dropdown-item' href='profile.php'>profile</a></li>";
                            echo     " <li><a class='dropdown-item' href='#'>Change Password</a></li> ";
                            echo     " <li><hr class='dropdown-divider' /></li>";
                            echo      "<li><a class='dropdown-item text-danger' href='SIGNOUT.php'>Sign-out</a></li>";
                                 
                            echo  "</ul>";
                            }

                                else if($current_page == $_SERVER['PHP_SELF']){
                                    echo "<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown'>";
                                    echo    " <li><a class='dropdown-item' href='courses.php'>courses</a></li>";
                                    echo    " <li><a class='dropdown-item' href='bookmark.php'>Bookmarks</a></li>";
                                    echo      "<li><a class='dropdown-item' href='profile.php'>profile</a></li>";
                                    echo     " <li><hr class='dropdown-divider' /></li>";
                                    echo      "<li><a class='dropdown-item text-danger' href='SIGNOUT.php'>Sign-out</a></li>";
                                         
                                    echo  "</ul>";
                                    }
                                    */
                            ?>


                        </li>
                    </ul>
                </div>
            </div>
        </nav>
       <?php                         
    }
    else {
        ?>
        <nav class="navbar navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.php">
                <img class="logo" src="../public/assets/section.jpg">Section</a>
                <a class="btn btn-primary" href="SIGNIN.php">Sign In/Up</a>
            </div>
        </nav>
        <?php
    }

?>