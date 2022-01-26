<?php 
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../db_connect.php');

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Information</title>
</head>
<body>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Personal Info</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tenant.php">Home</a></li>
              <li class="breadcrumb-item active">Personal Info</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
</section>
<!--Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Personal Info</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="code.php" method="post" enctype="multipart/form-data">
          <div class="card-body">
          <class="modal-body">
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

                <?php
                  $query_tenant="SELECT * FROM users INNER JOIN tenant ON users.userID = tenant.UserID WHERE tenant.UserID LIKE $userID LIMIT 1;";  
                  $query_tenant_run = mysqli_query($con, $query_tenant);
                ?>

             <?php while($row1 = mysqli_fetch_array($query_tenant_run)):;?>
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="fullName" value="<?php echo $row1['fullName']; ?>" class="form-control" placeholder="">
                      </div>
                     </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Email Address</label>
                        <input type="email" name="email" value="<?php echo $row1['email']; ?>" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">NRIC /IC</label>
                        <input type="text" name="identificationNo" value="<?php echo $row1['identificationNo'];?>" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Occupation</label>
                        <input type="text" name="occupation" value="<?php echo $row1['occupation'];?>" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Contact Number</label>
                        <input type="text" name="phoneNo" value="<?php echo $row1['phoneNo']; ?>" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" name="address" value="<?php echo $row1['address'];?>" class="form-control" placeholder=""> 
                      </div>
                    </div>
                        <input type="hidden" name="tenantID" value="<?php echo $row1['tenantID']; ?>" placeholder="">
                    </div>   
              <?php endwhile; ?>  
                  <div class="modal-footer">
                    <button type="submit"  name="updateTenant" class="btn btn-primary">Save </button>
                    <button type="reset" class="btn btn-secondary" value="Reset">Cancel</button>
                  </div>
          </div>
        </form>

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