<?php
session_start();
include "db_connect.php";

if(isset($_POST['registerBtn'])  && isset($_FILES['my_image']))
{
    

    echo "<pre>";
    print_r($_FILES['my_image']);
    echo "</pre>";
    
    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];
    $fullName =$_POST['fullName'];
    $username =$_POST['username'];
    $email =$_POST['email'];
    $phoneNo =$_POST['phoneNo'];
    $password =$_POST['password'];
    $confirmPass =$_POST['confirmPass'];
    $role = $_POST['role'];

    if($error === 0)
    {
        if ($img_size > 505000) {
        $em = "Sorry, your file size is too large!";
        header("Location: signUp.php?error=$em");
        }else{
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            
            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'admin/uploads/profile/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $email_query = "SELECT * FROM users WHERE email='$email'";
                $check_email = mysqli_query($con, $email_query);

                if (mysqli_num_rows($check_email) > 0)
                {
                    echo "<script type='text/javascript'>alert('Email already exist! Please use another email.');</script>";
                    echo '<style>body{display:none;}</style>';
                    echo '<script>window.location.href = "signUp.php";</script>';
                }
                else {
                    if ($password == $confirmPass)
                    {
                         //insert into database
                        $password = md5($password);
                        $query = "INSERT INTO users (fullName,username,email,phoneNo,password,role,profileImage) VALUES ('$fullName','$username','$email','$phoneNo','$password','$role','$new_img_name')";
                        $query_run = mysqli_query($con, $query);
                        if ($query_run)
                        {
                            echo "<script type='text/javascript'>alert('Registration is successful!');</script>";
                            echo '<style>body{display:none;}</style>';
                            echo '<script>window.location.href = "signIn.php";</script>';
                        }
                        else
                        {
                            echo "<script type='text/javascript'>alert('Registration is fail,please try again!');</script>";
                            echo '<style>body{display:none;}</style>';
                            echo '<script>window.location.href = "signUp.php";</script>';
                        }
                        
                    }
                    else { 
                            echo "<script type='text/javascript'>alert('Password and confirm password doesn't match!');</script>";
                            echo '<style>body{display:none;}</style>';
                            echo '<script>window.location.href = "signUp.php";</script>';
                    }
                            
                }
         

            }else{
                $em = "you can't upload files of this type";
                header("Location: signUp.php");
            }
        }
    }else{
        $em = "unknown error occured!";
        header("Location: signUp.php");
    }
}

else{
    header("Location: signUp.php");
}
?>

