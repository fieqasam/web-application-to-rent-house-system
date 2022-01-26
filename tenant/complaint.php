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
            <h1>Complaint</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tenant.php">Home</a></li>
              <li class="breadcrumb-item active">Complaint</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <?php
    include('../message.php');
  ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Make Complaint</h3>
          </div>
          <!-- /.card-header -->
  
          <!-- form start -->
          <form  action="code.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <?php
               $query_complaint=mysqli_query($con,"SELECT * FROM rental WHERE tenantID='$userID'");
              ?>
            <?php while($row = mysqli_fetch_array($query_complaint)):;?>
                    <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Name</label>
                         <input type="text" name="name" class="form-control" value= "<?php echo $fullName ?>" placeholder="">
                         </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Complaint</label>
                         <input type="text" name="complaintMessage" class="form-control" placeholder="">
                         </div>
                         </div>
                        <input type="hidden" name="houseID" value="<?php echo $row['houseID']; ?>" placeholder="">
                        <input type="hidden" name="tenantID" value="<?php echo $userID ?>" placeholder="">
                    </div>   
                    <?php endwhile; ?>  
                
                    <button type="submit"  name="submitComplaint" class="btn btn-primary">Submit </button>
                    <button type="reset" class="btn btn-secondary" value="Reset">Cancel</button>
                    
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