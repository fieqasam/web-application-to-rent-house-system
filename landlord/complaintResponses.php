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
<div class="content-wrapper">
    
<div class="content-header">
  <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Manage Complaints</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboardLandlord.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Complaints</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
       <?php
       include('../message.php');
       ?>
         <?php
        
           if (isset($_SESSION['status'])) 
           {
             echo"<h4>".$_SESSION['status']."</h4>";
             unset($_SESSION['status']);
           }
         ?>
         <div class="card">
             <!-- /.card-header -->
             <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                     <thead>
                     <tr>
                      <th style="width: 10px">Complaint No</th>
                      <th>Complaint Name</th>
                      <th>House Name</th>
                      <th>Complaint Message</th>
                      <th>Complaint Date</th>
                      <th>Status</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                     </thead>
                     <tbody>
                     <?php 
                     $sr_no = 1;
                     $query_complaint = mysqli_query($con, "SELECT * FROM complaint INNER JOIN houses ON complaint.houseID=houses.houseID WHERE houses.userID='$userID'");
                     while ($complaint_result = mysqli_fetch_assoc($query_complaint)) :?>
                                        <tr>
                      <td><?php echo $sr_no++; ?></td>
                      <td><?php echo $complaint_result['name']; ?></td>
                      <td><?php echo $complaint_result['houseName']; ?></td>
                      <td><?php echo $complaint_result['complaintMessage']; ?></td>
                      <td><?php echo $complaint_result['complaintDate']; ?></td>
                      <td>
                        <?php 
                        if ($complaint_result['statusComplaint'] == 0) 
                        {
                          ?> <h5><span class="badge bg-warning">In Process</span></h5><?php
                        }
                        else {
                          ?> <h5><span class="badge bg-success">Completed</span></h5> <?php
                        }
                        ?>
                      </td>
                      <td width=15%><a href="complaintDetails.php?complaintID=<?php echo $complaint_result['complaintID'] ?>" class="btn btn-info btn-sm">Take Action</a></td>
                    </tr>
                    <?php endwhile ?>
                  </tbody>
                 </table>    
             </div>
         </div>
       </div>
     </div>
   </div>
   </section>

</div>
<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>