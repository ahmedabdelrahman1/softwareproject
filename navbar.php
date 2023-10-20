<nav class="navbar navbar-expand-lg navbar-light bg-light bg-gradient static-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.html">
                    <img class="logo" src="static/assets/logo.jpg">7GES
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="mycourses.php">MY Courses</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Prices</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-primary fw-bold" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Derkos</a>
                            <?php
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
                            ?>


                        </li>
                    </ul>
                </div>
            </div>
        </nav>