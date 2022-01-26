<?php 
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../db_connect.php');

if (isset($_GET['respID'])) 
{
  $main_id = $_GET['respID'];

}

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
    
<div class="content-header">
  <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Checklist Form Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboardLandlord.php">Home</a></li>
              <li class="breadcrumb-item active">Checklist Form Detail</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 offset-1 mt-5">
          <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Checklist Details</h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
        <form  action="code.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <?php
               $query_form ="SELECT * FROM reponses INNER JOIN rental ON reponses.rentalID=rental.rentalID INNER JOIN houses ON rental.houseID=houses.houseID
                             WHERE reponses.respID='$main_id'";
               $query_form_run = mysqli_query($con, $query_form);
              
              ?>
            <?php while($row = mysqli_fetch_array($query_form_run)):;?>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">Checklist Form No</label>
                  <input type="text" name="respID" class="form-control" value="<?php echo $row['respID'] ?>">
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">Tenant Name</label>
                  <input type="text" name="name" class="form-control" value="<?php echo $row['tenantName'] ?>">
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">House Name</label>
                  <input type="text" name="name" class="form-control" value="<?php echo $row['houseName'] ?>">
                </div>
              </div>
              <div class="col-md-5">
              <div class="form-group">
                  <label for="">Status</label>
                  <select class="form-control" name="statusChecklist" class="from-control">
                    <option selected disabled>Choose</option>
                    <option value="In-Progress">In-Progress</option>
                    <option value="Complete">Complete</option>
                  </select>
                </div>
              </div>
              </div>      
            <?php endwhile; ?>  
              <div class="modal-footer">
                <button type="submit"  name="checklistFormBtn" class="btn btn-primary">Submit</button>
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
<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>