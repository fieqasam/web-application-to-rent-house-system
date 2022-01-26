<?php
session_start();
include('includes/header.php');
include('includes/sidebar.php');
include('includes/topbar.php');
include('../db_connect.php');
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

 <!-- Delete user -->

 <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Contract</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="code.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="delete_id" class="delete_term_id">
      <p>
        Are you sure you want to delete this data?
      </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="DeleteTermbtn" class="btn btn-primary">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete user -->

<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Listing Contract</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
              <li class="breadcrumb-item active">Listing Contract</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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
              <div style="overflow-x:auto;">
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr style="text-align:center;">
                          <th>Tenant's Name</th>
                          <th>Rent Paid(RM)</th>
                          <th>Duration
                          (Month)</th>
                          <th>Overall Payment
                          (RM)</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Contract</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query = "SELECT * FROM term t INNER JOIN tenantcheckin tc ON t.checkIn_ID = tc.checkIn_ID INNER JOIN tenant tn ON tn.tenantID = tc.tenantID WHERE t.userID LIKE $userID";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) 
                        {
                         //loop every iteration until last element
                         //for displaying all data once new data insert
                         foreach($query_run as $row)
                         {
                           //displaying all data in db
                           ?>
                         <tr style="text-align:center;">
                          <td hidden><?php echo $row['termID'] ?></td>
                          <td width="20%"><?php echo $row['fullName'] ?></td>
                          <td width="10%"><?php echo $row['monthlyPaid'] ?></td>
                          <td><?php echo $row['duration'] ?></td>
                          <td><?php echo $row['overallPayment'] ?></td>
                          <td width="15%"><?php echo $row['startDate'] ?></td>
                          <td width="15%"><?php echo $row['endDate'] ?></td>
                         
                         
                      </tr>
                           <?php
                         }
                        }
                        else
                        {
                          ?>
                          <tr>
                            <td>No record found.</td>
                          </tr>
                          <?php
                        }
                      ?>
                      </tbody>
                  </table>
                </div>    
              </div>
          </div>
        </div>
      </div>
    </div>
    </section>
</div>


</div>
</body>
</html>
<?php include('includes/script.php'); ?>
<!--script to delete user -->
<!--script to delete user -->
<script>
  $(document).ready(function(){
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        var userID = $(this).val();
        //console.log(userID);
        $('.delete_term_id').val(userID);
        $('#DeleteModal').modal('show');

    });
  });
</script>

<?php include('includes/footer.php'); ?> 