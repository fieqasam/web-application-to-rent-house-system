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

if (isset($_GET['complaintID'])) {
  $complaintID = $_GET['complaintID'];
  $sql_update = mysqli_query($con, "UPDATE complaint SET statusComplaint=3 WHERE complaintID='$complaintID'");
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

<div class="content-header">
  <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Notifications</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tenant.php">Home</a></li>
              <li class="breadcrumb-item active">Notifications</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>

 <!-- Delete user -->
 <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Message</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="code.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="delete_id" class="delete_complaint_id">
      <p>
        Are you sure you want to delete this message?
      </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="DeleteMessagebtn" class="btn btn-primary">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete user -->
<!-- Main Content -->
<section class="content">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
       <?php
       include('../message.php');
       ?>
         <div class="card">
             <!-- /.card-header -->
             <div class="card-body">
              <form action="" method="" enctype="multipart/form-data">
              <table id="example1" class="table table-bordered table-striped">
                     <thead>
                     <tr style="text-align:center">
                         <th>Sr_No</th>
                         <th>Message</th>
                         <th>Date</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                    <?php 
                    $sr_no = 1;
                    $query_complaint = mysqli_query($con, "SELECT * FROM complaint WHERE statusComplaint=2");
                    if (mysqli_num_rows($query_complaint)> 0) {
                      while ($row=mysqli_fetch_assoc($query_complaint)) {
                      
                          ?>
                          <tr style="text-align:center">
                          
                            <td scope="row"><?php echo $sr_no++; ?></td>
                            <td><?php echo $row['remarks']; ?></td>
                            <td><?php echo $row['complaintDate']; ?></td>
                            <td>
                            <button type="submit" name="delete_house" class="btn btn-danger deletebtn" value="<?php echo $row['complaintID']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
                            </td>
                          </tr>
                          <?php
                        }
                      
                      }
                    ?>
                    
                     </tbody>
                 </table>  
              </form>  
             </div>
         </div>
       </div>
     </div>
   </div>
   </section>


</div>
</body>
</html>
<?php include('includes/script.php');?>
  <!--script to delete message -->
  <script>
  $(document).ready(function(){
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        var complaintID = $(this).val();
        //console.log(userID);
        $('.delete_complaint_id').val(complaintID);
        $('#DeleteModal').modal('show');

    });
  });
</script>
<?php include('includes/footer.php');?>