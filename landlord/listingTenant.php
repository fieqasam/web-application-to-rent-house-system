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
        <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Listing Tenants</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
              <li class="breadcrumb-item active">Listing Tenants</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- Delete house -->

<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vacant House</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
<!-- Form to run the vacant tenant process -->
      <form action="code.php" method="POST">
      <div class="modal-body">
        <!-- Query to get the house info from rental table -->
        <?php 
        $query_house = mysqli_query($con, "SELECT * FROM rental INNER JOIN houses WHERE rental.houseID=houses.houseID AND landlordID='$userID'");
        while ($main_result = mysqli_fetch_assoc($query_house)) :?>
        <!-- input for rentalID -->
        <input type="hidden" name="delete_rental_id" class="delete_rental_id" value="<?php echo $main_result['rentalID']; ?>">
        <!-- input for houseID -->
        <input type="hidden" name="houseID" value="<?php echo $main_result['houseID']; ?>">
        <input type="hidden" name="contractFile" value="<?php echo $main_result['agreement']; ?>">
        <input type="hidden" name="pof" value="<?php echo $main_result['filePayment']; ?>">
        <?php endwhile ?>
      <p>
        Are you sure to vacant the house?
      </p>
      </div>
      <div class="modal-footer">
        <button type="submit" name="DeleteTenantbtn" class="btn btn-primary">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete Tenant -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                     <!-- card-header -->  
                     <div class="card-body">
                     <div style="overflow-x:auto;">
                         <table id="example1" class="table table-bordered table-striped">
                             <thead>
                                 <tr >
                                  <!-- Display information about tenant -->
                                    <th>House Name</th>
                                    <th>Tenant Name</th>
                                    <th>Tenant Email</th>
                                    <th>Tenant Contact No</th>
                                    <th width="15%">Monthly Rental Payment (RM)</th>
                                    <th width="10%">Deposit Paid (RM)</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php 
                                 $query = "SELECT * FROM rental INNER JOIN tenant ON rental.tenantID=tenant.userID INNER JOIN houses ON rental.houseID=houses.houseID WHERE rental.landlordID='$userID'";
                                 $query_run = mysqli_query($con, $query);

                                 if (mysqli_num_rows($query_run)> 0) 
                                 {
                                    foreach ($query_run as $row) {
                                    ?>
                                    <tr style="text-align:center">
                                        <th style="font-weight:normal"><?php echo $row['houseName']; ?></th>
                                        <th style="font-weight:normal"><?php echo $row['tenantName']; ?></th>
                                        <th style="font-weight:normal"><?php echo $row['tenantEmail']; ?></th>
                                        <th style="font-weight:normal"><?php echo $row['phoneNo'] ?></th>
                                        <th style="font-weight:normal"><?php echo $row['rentalPaid']; ?></th>
                                        <th style="font-weight:normal"><?php echo $row['deposit']; ?></th>
                                        <th style="font-weight:normal"> <button type="button" value="<?php echo $row['rentalID']; ?>" class="btn btn-danger btn-sm deletebtn">Vacant Tenant</button></th>
                                        <th><a href="rentalInfo.php?rentalID=<?php echo $row['rentalID']; ?>" class="btn btn-info btn-sm">Rental Details</a></th>
                                    </tr>
                                    <?php
                                    }
                                 }
                                 else {
                                    echo "<script>alert('No record found in the database');</script>"; 
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

<?php include('includes/script.php');?>
<!--script to delete category house -->
<script>
  $(document).ready(function(){
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        var rentalID = $(this).val();
        //console.log(userID);
        $('.delete_rental_id').val(rentalID);
        $('#DeleteModal').modal('show');

    });
  });
</script>

<?php include('includes/footer.php');?>
