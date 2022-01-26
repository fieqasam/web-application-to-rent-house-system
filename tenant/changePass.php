<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
<div class="content-wrapper"> 
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Change Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboardLandlord.php">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <?php
if (isset($_SESSION['auth'])) {
  $userID = $_SESSION['auth_user']['userID'];
  $fullName = $_SESSION['auth_user']['fullName'];
  $username = $_SESSION['auth_user']['username'];
  $email = $_SESSION['auth_user']['email'];
  $phoneNo = $_SESSION['auth_user']['phoneNo'];
  $role = $_SESSION['auth_user']['role'];
}
else
{
   echo "Not Logged In";
}
?>
 <?php
    include('../message.php');
 ?>
 <!-- /.content-header -->
 <section class="content">
        <div class="container">
            <div class="row">
             <div class="col-md-12  justify-content-center align-items-center">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-bold font-lg" >Change Password
                        </h3>
                        <a href="tenant.php" class="btn btn-danger btn-sm float-right">Back</a>
                    </div>
                    
                <!-- /.card-header -->
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12">
                        <form action="code.php" method="post" >
                        <input type="hidden" value="<?php echo $userID; ?>" name="userID">
                        <div class="form-group" >
                            <label for="">Current password</label>
                            <input type="password" class="form-control" name="currentPass" required>
                        </div>
                        <div class="form-group">
                            <label for="inputPasswordNew">New Password</label>
                            <input type="password" class="form-control" name="newPass" required="">
                            <span class="form-text small text-muted">
                            The password must be 8-20 characters, and must <em>not</em> contain spaces.
                            </span>
                         </div>
                         <div class="form-group">
                            <label for="inputPasswordNewVerify">Confirm Your Password</label>
                            <input type="password" class="form-control" name="confirmPass" required="">
                            <span class="form-text small text-muted">
                            To confirm, type the new password again.
                            </span>
                         </div>
                         <div class="form-group">
                            <button type="submit" name="changePassBtn" class="btn btn-success btn-lg float-right">Save</button>
                         </div>
                        </form>

                       </div> 
                </div>
             </div>
            </div>
        </div>
     </div>
    </section>

</div>
</body>
</html>
<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>