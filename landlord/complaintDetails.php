<?php 
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../db_connect.php');

if (isset($_GET['complaintID'])) 
{
  $main_id = $_GET['complaintID'];

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
          <h1 class="m-0 text-dark">Complaints Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboardLandlord.php">Home</a></li>
              <li class="breadcrumb-item active">Complaints Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Complaint Details</h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
        <form  action="code.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <?php
               $query_complaint = "SELECT * FROM complaint INNER JOIN houses ON complaint.houseID=houses.houseID WHERE complaint.complaintID='$main_id'";
               $query_complaint_run = mysqli_query($con, $query_complaint);
              
              ?>
            <?php while($row = mysqli_fetch_array($query_complaint_run)):;?>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Complaint No</label>
                  <input type="text" name="complaintNo" class="form-control" value="<?php echo $row['complaintID'] ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Complaint Name</label>
                  <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>">
                </div>
              </div>
              <div class="col-md-4">
              <div class="form-group">
                  <label for="">Status</label>
                  <select class="form-control" name="statusComplaint" class="from-control">
                    <option selected disabled>Choose</option>
                    <option value="1">In-Progress</option>
                    <option value="2">Completed</option>
                  </select>
                </div>
              </div>
              </div>   
              <div class="col-md-10">
                <div class="form-group">
                  <label>Remarks</label>
                  <textarea class="form-control" rows="3" name="remarks" placeholder="Enter Message"></textarea>
                </div>
              </div>
              <input type="hidden" name="complaintID" class="form-control" value="<?php echo $main_id; ?>">
            </div>       
            <?php endwhile; ?>  
              <div class="modal-footer">
                <button type="submit"  name="complaintResponses" class="btn btn-primary">Submit</button>
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