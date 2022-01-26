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
  <title>Rent House</title>
</head>
<body>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
              <li class="breadcrumb-item active">Admin Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!--Main content -->
<!-- Select user based on their session login -->
 <!-- /.content-header -->
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
  
 <!-- /.content-header -->
 <section class="content">
        <div class="container">
            <div class="row">
             <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-bold font-lg" >My Profile
                        </h4>
                    </div>
                    
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                        <form action="code.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                        <?php
                        include('../message.php');
                        ?>
                        <div class="upload-profile-image d-flex justify-content-center pb-5">
                          <div class="text-center">
                          <!-- display profile image based on userid-->
                          <?php
                        $sql = "SELECT profileImage FROM users WHERE userID='$userID'";
                        $res = mysqli_query($con, $sql);

                        if (mysqli_num_rows($res) > 0) {
                          while ($images = mysqli_fetch_assoc($res)) { ?>
                          <div class="alb">
                            <img class="img rounded-circle" src="../admin/uploads/profile/<?=$images['profileImage']?>" style="width: 200px; height: 200px;" >
                          </div>
                        <?php } } ?>
                          </div>
                          </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="<?php echo $fullName; ?>" class="form-control" placeholder="">
                              </div>
                            </div>
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" placeholder="">
                          </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Email Address</label>
                              <input type="text" name="contactNo" value="<?php echo $email; ?>" class="form-control" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Phone Number</label>
                              <input type="email" name="email" value="<?php echo $phoneNo; ?>" class="form-control" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">User Role</label>
                              <input type="text" name="role" value="<?php echo $role;?>" class="form-control" placeholder="">
                            </div>
                          </div>
                          <input type="hidden" name="userID" value="<?php echo $userID; ?>" placeholder="">
                        </div>   
                      
                        </div>
                        </form>
                        </div>
                </div>
             </div>
            </div>
        </div>
     </div>
    </section>

</body>
</html>

<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>