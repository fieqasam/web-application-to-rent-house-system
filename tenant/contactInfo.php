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
    <title>Contact Information</title>
</head>
<body>

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contact</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tenant.php">Home</a></li>
              <li class="breadcrumb-item active">Contact</li>
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
            <h3 class="card-title">Add Contact Info</h3>
          </div>
          <!-- /.card-header -->
  
          <!-- form start -->
          <form  action="code.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <?php
                $query_tenant="SELECT * FROM users INNER JOIN tenant ON users.userID = tenant.UserID WHERE tenant.UserID LIKE $userID LIMIT 1;";  
                $query_tenant_run = mysqli_query($con, $query_tenant);
              ?>
            <?php while($row1 = mysqli_fetch_array($query_tenant_run)):;?>
                    <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Name</label>
                         <input type="text" name="contactName" class="form-control" placeholder="">
                         </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Email</label>
                         <input type="email" name="email" class="form-control" placeholder="">
                         </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Mobile Phone Number</label>
                         <input type="text" name="contactNo" class="form-control" placeholder="">
                         </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Address</label>
                         <input type="text" name="address" class="form-control" placeholder="">
                         </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Occupation</label>
                         <input type="text" name="occupation" class="form-control" placeholder="">
                         </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Relationship</label>
                         <input type="text" name="relationContact" class="form-control" placeholder="">
                         </div>
                         </div>
                        <input type="hidden" name="tenantID" value="<?php echo $row1['userID']; ?>" placeholder="">
                    </div>   
                    <?php endwhile; ?>  
                    <div class="modal-footer">
                        <button type="submit"  name="addContact" class="btn btn-primary">Save </button>
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