<?php 
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../db_connect.php');

?>
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
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Upload Contract</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
              <li class="breadcrumb-item active">Upload contract</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
<section class="content">
  <div class="container">
  <div class="row">
  <div class="col-md-12">
  
  <div class="card">
    <div class="card-header">
    <h3 class=" text-bold font-lg">Upload Signed Contract</h3>
    <p style="color:grey;">After review the contract, upload your signed contract here.</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <?php 
              if (isset($_GET['rentalID'])) {
                $rentalID = $_GET['rentalID'];
                $query= "SELECT * FROM rental WHERE rentalID='$rentalID'";
                $query_run = mysqli_query($con, $query);
                if (mysqli_num_rows($query_run)>0) {
                  foreach ($query_run as $row) {
                    ?>
                    <form action="code.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                    <?php
                      include('../message.php');
                    ?>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                          <center><h5 class=" text-bold font-lg">The rental period is between</h5></center>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                          <input type="date" name="startDate" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                          <input type="date" name="endDate" class="form-control">
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="col-md-12">
                        <div class="form-group">
                          <center>
                          <label for="">Upload the contract signed by <a href="#" ><?php echo $fullName ?></a> as the landlord and <a href="#" ><?php echo $row['tenantName'] ?></a> as the tennat.</label>
                          <input type="file" name="uploadSignedContract" class="form-control" required>
                          <input type="hidden" name="file_old" value="<?php echo $row['agreement']; ?>" class="form-control" > 
                          <input type="hidden" name="rentalID" value="<?php echo $row['rentalID'] ?>" class="form-control" >
                          <input type="hidden" name="houseID" value="<?php echo $row['houseID']; ?>" class="form-control">
                          <input type="hidden" name="tenantID" value="<?php echo $row['tenantID']; ?>" placeholder="">
                        </center>
                        </div>
                      </div>
                      <div class="modal-footer">
                      <button type="submit" name="update_signed_contract" class="btn btn-primary">Rent To Tenant</button>
                      <button type="reset" class="btn btn-secondary" value="Reset">Cancel</button>
                      </div>
                    </form>
                    <?php                    
                  }
                }
                
              }
              ?>
           </div>
        </div>
    </div>

  </div>
  </div>
  </div>
  </div>     
</section>

</div>
<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>