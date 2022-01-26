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
  <title>Rent House</title>
</head>
<body>
<div class="content-wrapper">

<div class="content-header">
  <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Payment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tenant.php">Home</a></li>
              <li class="breadcrumb-item active">Payment</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
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
                         <th>Due Date</th>
                         <th>Property</th>
                         <th>Total/Paid (RM)</th>
                         <th>Status</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                    <?php 
                    $query_rental = mysqli_query($con, "SELECT * FROM payment INNER JOIN rental ON payment.rentalID=rental.rentalID INNER JOIN houses ON rental.houseID=houses.houseID WHERE payment.tenantID='$userID'");
                    if (mysqli_num_rows($query_rental)> 0) {
                      while ($row=mysqli_fetch_assoc($query_rental)) {

                          ?>
                          <tr style="text-align:center">
                          
                            <td><?php echo $row['dueDate']; ?></td>
                            <td><?php echo $row['houseName']; ?></td>
                            <td><?php echo $row['rentalPaid']; ?></td>
                            <td>
                              <!-- please check back the logic! -->
                              <?php 
                              $statusPayment = $row['statusPayment'];
                                if ($statusPayment == 'unpaid') {
                                  ?> <h5><span class="badge bg-warning">Unpaid<span></h5> <?php
                                }
                                elseif ($statusPayment == 'Paid') 
                                {
                                  ?> <h5><span class="badge bg-success">Paid</span></h5> <?php
                                }
                               else {
                                  ?> <h5><span class="badge bg-danger">Late</span></h5> <?php
                                }
                                
                              ?>
                            </td>
                            <td>
                              <?php 
                              if ($statusPayment == 'unpaid') {
                              ?><a href="pay.php?paymentID=<?php echo $row['paymentID']; ?>" class="btn btn-info btn-sm">Pay Now</a><?php
                              }else {
                                ?>  <button type="submit" name="delete_house" class="btn btn-info btn-sm" disabled>Pay Now</button><?php
                              }
                              ?>
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
<?php include('includes/footer.php');?>
