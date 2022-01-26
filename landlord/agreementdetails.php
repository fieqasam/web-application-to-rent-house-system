<?php
session_start();
include('includes/header.php');
include('includes/sidebar.php');
include('includes/topbar.php');
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
          <h1 class="m-0 text-dark">Listing Agreement</h1>
          <p style="color:grey;">List all uploaded agreement information</p>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
              <li class="breadcrumb-item active">Listing Agreement</li>
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
                          <th>House Name</th>
                          <th>Agreement</th>
                          <th>Proof of Payment</th>
                          <th>Date Submit</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query = "SELECT * FROM rental INNER JOIN houses ON rental.houseID=houses.houseID WHERE landlordID LIKE $userID";
                        $query_run = mysqli_query($con, $query);
                        $query_house = "SELECT * FROM houses LIMIT 1";
                        $query_house_run = mysqli_query($con,$query_house);
    
                        if (mysqli_num_rows($query_run) > 0) 
                        {
                         //loop every iteration until last element
                         //for displaying all data once new data insert
                         foreach($query_run as $row)
                         {
                           //displaying all data in db
                           ?>
                         <tr style="text-align:center;">
                          <td><?php echo $row['tenantName']; ?></td>
                          <td><?php echo $row['houseName']; ?></td>
                          <td> <a href="contractDownload.php?contract=<?php echo $row['agreement'] ?>"><?php echo $row['agreement'] ?></a> </td> 
                          <td> <a href="contractDownload2.php?filePayment=<?php echo $row['filePayment'] ?>"><?php echo $row['filePayment'] ?></a> </td> 
                          <td><?php echo $row['dateSubmit']; ?></td>
                          <td> <a href="uploadContract.php?rentalID=<?php echo $row['rentalID']; ?>" class="btn btn-info btn-sm">Action</a> </td>
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
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?> 