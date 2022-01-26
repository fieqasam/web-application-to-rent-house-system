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
  <style>
     @import url('https://fonts.googleapis.com/css?family=Ubuntu&display=swap');

    :root{
        --font-ubuntu: 'Ubuntu', monospace;
        --color-border: #e5e5e5;
    }

    .font-ubuntu{
        font: normal 500 16px var(--font-ubuntu);
    }
  </style>
</head>
<body>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Upload Files</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Upload Files</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php
      include('../message.php');
    ?>

  <section class="content">
    <div class="container-fluid">
      <div class="row ">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Upload Files</h3>
            </div>
          <!-- /.card-header -->
          <!-- form start -->             
          <?php
            $submit_file = mysqli_Query($con, "SELECT * FROM rental WHERE rental.tenantID='$userID'");
          ?>
          <form action="code.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                  <div class="text-center col-md-6">
                  <div class="alb">
                    <img class="img rounded-circle" src="../admin/uploads/fileUpload.png" style="width: 200px; height: 200px;" >
                  </div>
                </div>
                 <!-- display logo file -->
                <div class=" text-center col-md-6">
                  <div class="alb">
                    <img class="img rounded-circle" src="../admin/uploads/fileUpload.png" style="width: 200px; height: 200px;" >
                  </div>
                </div>
                </div>
                <!-- display logo file -->
              <div class="row">
                <div class="col-md-6 ">
                <div class="form-group">
                  <label for="">Signed Lease Agreement</label>
                  <div class="input-group">
                      <div class="custom-file">
                      <input type="file" name="fileContract"  id="exampleInputFile" class="custom-file-input">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
              
                    </div>
                    <p class="help-block" style="color:blue;" ><b> .PDF Files Only</b></p>
                </div>
                </div>
                <!-- file payment section -->
                <div class="col-md-6">
                  <div class="form-group">
                  <label for="exampleInputFile">Proof of Payment</label>
                  <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="filePayment" id="exampleInputFile" class="custom-file-input"> 
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                     
                    </div>
                    <p class="help-block" style="color:blue;" ><b> .PDF Files Only</b></p>
                  <?php while($row = mysqli_fetch_array($submit_file)):;?>
                    <input type="hidden" name="tenantID" value="<?php echo $row['tenantID'] ?>">
                    <input type="hidden" name="tenantName" value="<?php echo $row['tenantName'] ?>">
                    <input type="hidden" name="emailTenant" value="<?php echo $row['tenantEmail'] ?>">
                    <input type="hidden" name="emailLandlord" value="<?php echo $row['landlordEmail'] ?>">
                    <input type="hidden" name="houseID" value="<?php echo $row['houseID'] ?>">
                  <?php endwhile; ?> 
                  </div>
                </div>
              </div>
              <div class="col-md-11">
                <div class="modal-footer">
                  <button type="submit" name="submitFile" class="btn btn-primary btn-lg btn-block">Save</button>
                </div>
              </div>
                
            </div>
          </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>

<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>
