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

if (isset($_GET['rentalID'])) 
{
  $main_id = $_GET['rentalID'];
}
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
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rental Info</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
              <li class="breadcrumb-item active">Rental Info</li>
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
            <h3 class="card-title">Rental Info</h3>
          </div>
          <!-- /.card-header -->
  
          <!-- form start -->
          <form  action="code.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <?php
                $query_rental="SELECT * FROM rental INNER JOIN houses ON rental.houseID=houses.houseID WHERE rental.rentalID='$main_id'";  
                $query_rental_run = mysqli_query($con, $query_rental);
              ?>
            <?php while($row = mysqli_fetch_array($query_rental_run)):;?>
                    <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Tenant Name</label>
                         <input type="text" name="" class="form-control" value="<?php echo $row['tenantName'] ?>">
                         </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                         <label for="">House Name</label>
                         <input type="text" name="" class="form-control" value="<?php echo $row['houseName'] ?>">
                         </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Monthly Rental</label>
                         <input type="text" name="" class="form-control" value="<?php echo $row['rentalPaid'] ?>">
                         </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Deposit</label>
                         <input type="text" name="" class="form-control" value="<?php echo $row['deposit'] ?>">
                         </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Start Date</label>
                         <input type="text" name="startDate" class="form-control" Value="<?php echo $row['startDate'] ?>">
                         </div>
                         </div>
                         <div class="col-md-6">
                         <div class="form-group">
                         <label for="">End Date</label>
                         <input type="text" name="endDate" class="form-control" value="<?php echo $row['endDate'] ?>">
                         </div>
                         </div>
                        <input type="hidden" name="tenantID" value="<?php echo $row['tenantID']; ?>" placeholder="">
                        <input type="hidden" name="rentalID" value="<?php echo $row['rentalID']; ?>" placeholder="">
                    </div>   
                    <?php endwhile; ?>  
                    <div class="modal-footer">
                        <button type="submit"  name="addRentalDetails" class="btn btn-primary">Save </button>
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