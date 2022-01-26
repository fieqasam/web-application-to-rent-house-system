<?php
session_start();
include('includes/header.php');
include('includes/sidebar.php');
include('includes/topbar.php');
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
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Compose Message</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="content-wrapper">
      <!-- /.content-header -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Upload Checklist Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
              <li class="breadcrumb-item active">Upload Checklist Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php  
      $query_reponse = mysqli_query($con, "SELECT * FROM rental WHERE tenantID='$userID'");
    ?>
    <section class="content">
      <div class="container">
      <div class="col-md-12">
            <div class="card card-secondary">
              <div class="card-header">
                  <h3 class="card-title">Upload Checklist Form</h3>
                </div>
              <!-- /.card-header -->
              <form action="code.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                <?php while($row = mysqli_fetch_array($query_reponse)):;?>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="rentalID" value="<?php echo $row['rentalID']; ?>" placeholder="rentalID:">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="landlordEmail" value="<?php echo $row['landlordEmail']; ?>" placeholder="landlord email:">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="landlordID" value="<?php echo $row['landlordID']; ?>" placeholder="landlord email:">
                  </div>
                </div>
                <div class="col-md-9">
                <div class="form-group">
                  <label for="" >Name</label>
                  <input class="form-control" name="tenantName" value="<?php echo $row['tenantName']; ?>"">
                </div>
                </div>
                <div class="col-md-9">
                <div class="form-group">
                  <label for="">Subject</label>
                  <input type="text" class="form-control" name="subject" value="Responses Checklist Form" >
                </div>
                </div>
               <div class="col-md-9">
               <div class="form-group">
                  <label for="">Message</label>
                    <textarea class="form-control" name="message" style="height: 100px"> </textarea>
                    <?php endwhile; ?>
                </div>
               </div>
               <div class="col-md-6">
               <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> Attachment
                    <input type="file" name="attachment"class="form-control">
                  </div>
                  <p class="help-block">Max. 32MB</p>
                </div>
                </div>
               </div>
              </div>
               <!-- /.card-body -->
               <div class="card-footer">
                <div class="float-right">
                  <button type="reset" class="btn btn-default"></i> Cancel</button>
                  <button type="submit" class="btn btn-primary" name="submitResponse"></i> Send</button>
                </div>
               
              </div>
             
              </div>
              </form>
              <!-- /.card-footer -->
      </div>
    </section>
</div> 
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="asssets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>
</body>
</html>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?> 