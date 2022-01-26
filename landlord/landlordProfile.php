<?php 
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../db_connect.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent House| Landlord Profile</title>
</head>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark"> My Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboardLandlord.php">Home</a></li>
              <li class="breadcrumb-item active">My Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!--Main content -->
<!-- Select user based on their session login -->
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
                          <?php
                           $query_landlord="SELECT * FROM users INNER JOIN landlord ON users.userID = landlord.UserID WHERE landlord.UserID LIKE $userID LIMIT 1;";  
                           $query_landlord_run = mysqli_query($con, $query_landlord);
                          ?>

                        <?php while($row1 = mysqli_fetch_array($query_landlord_run)):;?>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="<?php echo $row1['name']; ?>" class="form-control" placeholder="">
                              </div>
                            </div>
                          <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" value="<?php echo $row1['username']; ?>" class="form-control" placeholder="">
                          </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Contact Number</label>
                              <input type="text" name="contactNo" value="<?php echo $row1['contactNo']; ?>" class="form-control" placeholder="">
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
                              <label for="">Identification Number/IC</label>
                              <input type="text" name="identityNo" value="<?php echo $row1['identityNo'];?>" class="form-control" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Address</label>
                              <input type="text" name="address" value="<?php echo $row1['address'];?>" class="form-control" placeholder=""> 
                            </div>
                          </div>
                          <input type="hidden" name="landlordID" value="<?php echo $row1['landlordID']; ?>" placeholder="">
                        </div>   
                        <?php endwhile; ?>  
                        <div class="modal-footer">
                          <button type="submit"  name="updateLandlord" class="btn btn-primary">Save </button>
                          <button type="reset" class="btn btn-secondary" value="Reset">Cancel</button>
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

<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>