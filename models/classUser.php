<?php
require_once("Models.php");
class User extends Model {
    private $id;
    private $fname;
    private $lname;
    private $email;
    private $passw;
    private $type;
    private $imgId;
    private$imgUrl;
    private $userId;
    public $alerts=[];
    
    public function __construct($id = "", $fname = "", $lname = "", $email = "", $passw = "", $type = "",$imgId="",$imgUrl="", $userId="")
    {
        $this->db = $this->connect();

        $this->id = $id;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->fname = $fname;
        $this->email = $email;
        $this->passw = $passw;
        $this->type = $type;
        $this->imgId = $imgId;
        $this->imgUrl = $imgUrl;
        $this->userId = $userId;

    }

    public  function sign_up($fname, $lname, $email, $passw, $type,$imgUrl, $userId) {
        $sql = "INSERT INTO user(fname, lname, email, password, type) VALUES(?,?,?,?,?)";
          // Insert user details
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sssis', $fname, $lname, $email, $passw, $type);


        $add = "INSERT INTO images (img_url, user_id) VALUES (?,?)";
        $stt = $this->db->prepare($add);
        $stt->bind_param('si', $imgUrl, $userId);

        if ($stmt->execute()) {
            Sign::$alerts[] = "Added!";
        } else {
            Sign::$alerts[] = "Not added!";
        }

        if ($stt->execute()) {
            Sign::$alerts[] = "photo Added!";
        } else {
            Sign::$alerts[] = "photo Not added!";
        }

        $stmt->close();
        $stt->close();
    }

    public function sign_out(){

    session_start();
    session_unset();
    session_destroy();
    header('location:index.php');

    exit;
    }


    public function getUserByID($userId) {
        try {
            $checkQuery =$this->db->prepare("SELECT * FROM user WHERE id = ?");
            $checkQuery->bind_param('i', $userId);
            $checkQuery->execute();

            // Fetch the result to determine if the course exists
            $checkQuery->store_result();

            if ($checkQuery->num_rows > 0) {
                // User found, proceed with deletion

                $getUserQuery = $this->db->prepare("SELECT * FROM user WHERE id = ?");
                $getUserQuery->bind_param('i', $userId);
                $getUserQuery->execute();
                $result = $getUserQuery->get_result();

                if($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    return $user;
                } else {
                    return null; // User not found
                }
        } else{
            return null; // User not found
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

    public function getAllUsers()
    {
        $getAllUsers = "SELECT * FROM user";
        $result = $this->db->query($getAllUsers);
        return $result;
    }
    public function editUser($fname, $lname, $email,$userId) {

        // Check if the user with the given ID exists
        $checkQuery = $this->db->prepare("SELECT * FROM user WHERE id = ?");
        $checkQuery->bind_param('i', $userID);
        $checkQuery->execute();

        if ($checkQuery->fetch()) {

        $checkQuery->close();

        $edit = $this->db->prepare("UPDATE user SET fname = ? , lname = ? , email = ? WHERE id = ?");
        $edit->bind_param('sssi',$fname,$lname,$email,$userId);

        if ($edit->execute()) {
            User::$alerts[] = "Edited!";
            header("location: profile.php");

        } else {
            User::$alerts[] = "Not Edited!";
            $em = "Failed to update the database.";
            header("location: index.php?error=$em");
        }
    } else{
            User::$alerts[] = "Not Edited!";
            $em = "Failed to update the database.";
            header("location: index.php?error=$em");
    }
    }

    public function deleteUserByID($userId) {
        try {
            $checkQuery =$this->db->prepare("SELECT * FROM user WHERE id = ?");
            $checkQuery->bind_param('i', $userId);
            $checkQuery->execute();

            // Fetch the result to determine if the course exists
            $checkQuery->store_result();

            if ($checkQuery->num_rows > 0) {
                // User found, proceed with deletion

            $delete = $this->db->prepare("DELETE FROM user WHERE id = ?");
            $delete->bind_param('i',$userId);
            $delete->execute();

            if ($delete->affected_rows > 0) {
                User::$alerts[] = "User Deleted!";
            } else {
                User::$alerts[] = "User Not Deleted!";
            }
        } else{
            User::$alerts[] = "User Not Deleted!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


// Delete image by user ID 
    public function deleteImageBy_userID($userId) {

            try {
                $checkQuery =$this->db->prepare("SELECT * FROM user WHERE id = ?");
                $checkQuery->bind_param('i', $userId);
                $checkQuery->execute();
    
                // Fetch the result to determine if the course exists
                $checkQuery->store_result();
    
                if ($checkQuery->num_rows > 0) {
                    // Course found, proceed with deletion
    
                $delete_image = $this->db->prepare("DELETE FROM images WHERE user_id = ?");
                $delete_image->bind_param('i',$userId);
                $delete_image->execute();
    
                if ($delete_image->affected_rows > 0) {
                    User::$alerts[] = "photo Deleted!";
                } else {
                    User::$alerts[] = "photo Not Deleted!";
                }
            } else{
                User::$alerts[] = "photo Not Deleted!";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Delete image by image ID 
    public function deleteImageBy_ID($imgId) {

        try {
            $checkQuery =$this->db->prepare("SELECT * FROM images WHERE img_id = ?");
            $checkQuery->bind_param('i', $img_id);
            $checkQuery->execute();

            // Fetch the result to determine if the course exists
            $checkQuery->store_result();

            if ($checkQuery->num_rows > 0) {
                // Course found, proceed with deletion

            $delete_image = $this->db->prepare("DELETE FROM images WHERE img_id = ?");
            $delete_image->bind_param('i',$imgId);
            $delete_image->execute();

            if ($delete_image->affected_rows > 0) {
                User::$alerts[] = "photo Deleted!";
            } else {
                User::$alerts[] = "photo Not Deleted!";
            }
        } else{
            User::$alerts[] = "photo Not Deleted!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

    public function deleteAllUsers() {

        try {
            // Check if there are any users
            $checkUsersQuery = $this->db->query("SELECT COUNT(*) FROM user");
            $userCount = $checkUsersQuery->fetch_row()[0];

            if ($userCount > 0) {
                // Delete all users
                $deleteAll = $this->db->prepare("DELETE FROM user");
                $deleteAll->execute();

                if ($deleteAll->affected_rows > 0) {
                    User::$alerts[] = "All Users Deleted!";
                } else {
                    User::$alerts[] = "No Users Deleted!";
                }
            } else {
                User::$alerts[] = "No Users to Delete!";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
    }

    public function deleteAllimages() {

        try {
            // Check if there are any images
            $checkUsersQuery = $this->db->query("SELECT COUNT(*) FROM images");
            $imageCount = $checkUsersQuery->fetch_row()[0];

            if ($imageCount > 0) {
                // Delete all images
                $deleteAll = $this->db->prepare("DELETE FROM images");
                $deleteAll->execute();

                if ($deleteAll->affected_rows > 0) {
                    User::$alerts[] = "All images Deleted!";
                } else {
                    User::$alerts[] = "No images Deleted!";
                }
            } else {
                User::$alerts[] = "No images to Delete!";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    //Setters
    // public function setId($id) {
    //     $this->id = $id;
    // }

    public function setFname($fname) {
        $this->fname = $fname;
    }

    public function setLname($lname) {
        $this->lname = $lname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($passw) {
        $this->passw = $passw;
    }

    public function setType($type) {
        $this->type = $type;
    }

    // public function setuserId($imgId) {
    //     $this->imgId = $imgId;
    // }

    public function setimgUrl($imgUrl) {
        $this->imgUrl = $imgUrl;
    }

    // public function setuserId($userId) {
    //     $this->userId = $userId;
    // }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getFname() {
        return $this->fname;
    }

    public function getLname() {
        return $this->lname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->passw;
    }

    public function getType() {
        return $this->type;
    }

    public function getimgId() {
        return $this->imgId;
    }
    public function getimgUrl() {
        return $this->imgUrl;
    }

    public function getuserId() {
        return $this->userId;
    }

    public function Edit_uploadProfileImage($imgUrl) {
        try {
            session_start();

            if (isset($_POST['submit']) && isset($_FILES[$imgUrl])) {
                $tmp_name = $_FILES[$imgUrl]['tmp_name'];
                $error = $_FILES[$imgUrl]['error'];
                $user_id = $_SESSION['user_id']; // Assuming you have the user_id in the session

                if ($error === 0) {
                    $img_size = $_FILES[$imgUrl]['size'];
                    $img_name = $_FILES[$imgUrl]['name'];

                    if ($img_size > 125000) {
                        $em = "Sorry, the image is too large.";
                        header("location: index.php?error=$em");
                    } else {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);

                        $allowed_exs = array("jpg", "jpeg", "png");

                        if (in_array($img_ex_lc, $allowed_exs)) {
                            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                            $img_upload_path = 'uploads/' . $new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);

                            // Update the image URL in the database
                            $sql = $this->db->prepare("UPDATE images SET img_url = ? WHERE user_id = ?");
                            $sql->bind_param("si", $new_img_name, $user_id);
                            $res = $sql->execute();
                            $sql->close();

                            if ($res) {
                                header("location: profile.php");
                            } else {
                                $em = "Failed to update the database.";
                                header("location: courses.php?error=$em");
                            }
                        } else {
                            $em = "Wrong file type. Only JPG, JPEG, and PNG are allowed.";
                            header("location: courses.php?error=$em");
                        }
                    }
                } else {
                    $em = "Unknown error!";
                    header("location: courses.php?error=$em");
                }
            } else {
                header("location: index.php");
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
?>