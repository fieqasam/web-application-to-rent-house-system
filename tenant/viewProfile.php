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
  <title>RENT HOUSE</title>
</head>
<body>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tenant.php">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
         <!-- Profile Image -->
         <div class="card card-secondary card-outline">
           <div class="card-body box-profile">
             <?php 
             $query_profile=mysqli_query($con, "SELECT * FROM users INNER JOIN tenant ON users.userID=tenant.userID WHERE tenant.userID='$userID'");

             if (mysqli_num_rows($query_profile) > 0) {
               while ($row = mysqli_fetch_assoc($query_profile)) {
                 ?>
                <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                          src="../admin/uploads/profile/<?=$row['profileImage']?>"  style="width: 150px; height: 150px;"
                          alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?php echo $row['fullName'] ?></h3>
                <p class="text-muted text-center"><?php echo $row['occupation'] ?></p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                <b>Email</b> <a class="float-right"><?php echo $row['email'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>NRIC</b> <a class="float-right"><?php echo $row['identificationNo'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Contact No</b> <a class="float-right"><?php echo $row['phoneNo'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Address</b> <a class="float-right"><?php echo $row['address'] ?></a>
                </li>
              </ul>
              <?php
               }
             }
             ?>
            <a href="tenantInfo.php" class="btn btn-primary btn-block"><b>Profile</b></a>
           </div>
          <!-- /.card-body -->
         </div>
          <!-- /.card -->
        </div>
      <!-- /.col -->
      <div class="col-md-8">
        <div class="card card-secondary">
          <div class="card-header">
          <h3 class="card-title">Contact Info</h3>
          </div>
          <!-- /.card-header -->
          <!-- contact Info start -->
          <div class="card-body">
            <div class="row">
              <div class="col-12">
              <div class="post">
                <div class="user-block">
                      
              <?php 
                $query_contact = mysqli_query($con, "SELECT * FROM contactinformation WHERE tenantID='$userID'");
                
                if (mysqli_num_rows($query_contact) > 0) {
                  while ($row2 = mysqli_fetch_assoc($query_contact)) {
                    ?>
                      <h5><b><i class="fas fa-md fa-user-alt"></i>&nbsp;<?php echo $row2['contactName'] ?></b></h5>
                      <p class="text-muted text-md"><b>Address: </b> <?php echo $row2['address'] ?></p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="medium"><span class="fa-li"><i class="fas fa-md fa-envelope"></i></span> Email: <?php echo $row2['email'] ?></li>
                        <li class="medium"><span class="fa-li"><i class="fas fa-md fa-phone"></i></span> Phone #: + 60 -<?php echo $row2['contactNo'] ?></li>
                        <li class="medium"><span class="fa-li"><i class="fas fa-md fa-user-circle"></i></span> Occupation: <?php echo $row2['occupation'] ?></li>
                        <li class="medium"><span class="fa-li"><i class="fas fa-md fa-handshake"></i></span> Relationship: <?php echo $row2['relationContact'] ?></li>
                      </ul>
                    <br>
                    <?php
                  }
                }
              ?>
                </div>
              </div>
            </div>
          </div>

        </div>
        </div>
        <!-- /.col-md-9 -->
      </div>
      </div>
    </div>
    
  </section>

  </div>
</body>
</html>

<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>