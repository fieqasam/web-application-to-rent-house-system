<?php
session_start();
include('db_connect.php');
//when login button is clicked
if (isset($_POST['loginBtn'])) 
{
   $email = $_POST['email'];
   $password = $_POST['password'];
   $password = md5($password);
   $role = $_POST['role'];

   $log_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1 ";
   $log_query_run = mysqli_query($con, $log_query);

   if (mysqli_num_rows($log_query_run) > 0) 
   {
      foreach($log_query_run as $row)
      {
        $userID = $row['userID'];
        $fullName = $row['fullName'];
        $username = $row['username'];
        $email = $row['email'];
        $phoneNo = $row['phoneNo'];
        $password = $row['password'];
        $role = $row['role'];
      }

      $_SESSION['auth'] = "$role";
      $_SESSION['auth_user'] = [
          'userID'=>$userID,
          'fullName'=>$fullName,
          'username'=>$username,
          'email'=>$email,
          'phoneNo'=>$phoneNo,
          'password'=>$password,
          'role'=>$role
      ];
      //validate user based on their role
      if ($_SESSION['auth'] == "Admin") 
      {
        echo "<script type='text/javascript'>alert('Logged in successfully!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "admin/admin.php";</script>';
        exit(0);
      }
      elseif ($_SESSION['auth'] == "Landlord") 
      {

        $userid_query = "SELECT * FROM users INNER JOIN landlord ON users.userID = landlord.UserID WHERE landlord.UserID LIKE $userID LIMIT 1;";
        $check_userid = mysqli_query($con, $userid_query);

        if (mysqli_num_rows($check_userid) > 0) 
        {
            echo "<script type='text/javascript'>alert('Welcome to rental house,$username');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "landlord/landlord.php";</script>';
            exit(0);
        }

        else 
        {
          $user_query = "INSERT INTO landlord(name,username,email,contactNo,userID) VALUES ('$fullName','$username','$email','$phoneNo','$userID')";
          $user_query_run = mysqli_query($con, $user_query);

          if ($user_query_run) 
          {
            echo "<script type='text/javascript'>alert('Logged in successfully.');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "landlord/landlord.php";</script>';
            exit(0);
          }
          else 
          {
            echo "<script type='text/javascript'>alert('Logged in failed! Please try again.');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "signIn.php";</script>';
          }
        
        }
        
      }
      else if ($_SESSION['auth'] == "Tenant") 
      {
            $tenant_query = "SELECT * FROM users INNER JOIN tenant ON users.userID = tenant.UserID WHERE  tenant.UserID LIKE $userID LIMIT 1;";
            $check_tenant_query = mysqli_query($con, $tenant_query);
             if (mysqli_num_rows( $check_tenant_query) > 0) 
             {
                echo "<script type='text/javascript'>alert('Welcome to rental house,$fullName');</script>";
                echo '<style>body{display:none;}</style>';
                echo '<script>window.location.href = "tenant/tenant.php";</script>';
                exit(0);
             }
             else 
             {
              $user_query = "INSERT INTO tenant(fullName,email,phoneNo,userID) VALUES ('$fullName','$email','$phoneNo','$userID')";
              $user_query_run = mysqli_query($con, $user_query);
              if ( $user_query_run) 
              {
                echo "<script type='text/javascript'>alert('Logged in successfully!');</script>";
                echo '<style>body{display:none;}</style>';
                echo '<script>window.location.href = "tenant/tenant.php";</script>';
                exit(0);
              }
              else
              {
                echo "<script type='text/javascript'>alert('Logged in failed!Please try again.');</script>";
                echo '<style>body{display:none;}</style>';
                echo '<script>window.location.href = "signIn.php";</script>';
              }
             }
      }
      
     
   }
   
   else
   {
    echo "<script type='text/javascript'>alert('Invalid email or password!');</script>";
    echo '<style>body{display:none;}</style>';
    echo '<script>window.location.href = "signIn.php";</script>';
   }
}
else
{
    echo "<script type='text/javascript'>alert('Access Denied.Please register');</script>";
    echo '<style>body{display:none;}</style>';
    echo '<script>window.location.href = "signIn.php";</script>';
}
?>