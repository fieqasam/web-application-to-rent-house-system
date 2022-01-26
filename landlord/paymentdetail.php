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
  </head>
<body>
<div class="content-wrapper">

<div class="content-header">
  <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboardLandlord.php">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
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
        <h5 class="modal-title" id="exampleModalLabel">Delete Invoice</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="code.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="delete_id" class="delete_rental_id">
      <p>
        Are you sure you want to delete this invoice?
      </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="DeleteInvoicebtn" class="btn btn-primary">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete user -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
        
          <!-- /.card-header -->
  
          <!-- form start -->
          <form  action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
    
<!-- display tenant rental info-->      
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                     <thead>
                     <tr style="text-align:center">
                         <th>Tenant's Name</th>
                         <th>House Name</th>
                         <th>Reference No</th>
                         <th>Due Date</th>
                         <th>Amount Pay (RM)</th>
                         <th>Date Pay</th>
                         <th>Status Payment</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     <?php
                        $query_search = "SELECT * FROM payment INNER JOIN rental ON payment.tenantID=rental.tenantID  INNER JOIN houses ON rental.houseID=houses.houseID WHERE rental.landlordID='$userID' AND payment.statusPayment='Paid'";
                        $query_search_run = mysqli_query($con, $query_search);

                        if (mysqli_num_rows($query_search_run)> 0) {
                          
                          foreach ($query_search_run as $row) {

                            ?>
                            <tr style="text-align:center">
                              <td><?php echo $row['tenantName']; ?></td>
                              <td><?php echo $row['houseName']; ?></td>
                              <td><?php echo $row['refNo']; ?></td>
                              <td width=15%;><?php echo $row['dueDate']; ?></td>
                              <td><?php echo $row['amountPay']; ?></td>
                              <td><?php echo $row['datePay']; ?></td>
                              <td>
                                <?php
                                if ($row['statusPayment']=='Paid') {
                                  ?> <h5><span class="badge bg-success">Paid</span></h5> <?php
                                }else {
                                  ?> <h5><span class="badge bg-warning">Unpaid<span></h5> <?php
                                }
                              ?>
                              </td>
                              <td width=15%; style="text-align:center"> <a href="invoice-pdf.php?paymentID=<?php echo $row['paymentID']; ?>" class="btn btn-info btn-sm"><i class="fas fa-print"></i></a>
                              <button type="submit" name="delete_invoice" class="btn btn-danger btn-sm deletebtn" value="<?php echo $row['paymentID']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
                            </td>
                            </tr>
                         <?php

                          }
                        }
                     ?>
                     
                     </tbody>
                 </table>  
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
<!--script to delete category house -->
<script>
  $(document).ready(function(){
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        var paymentID = $(this).val();
        //console.log(userID);
        $('.delete_rental_id').val(paymentID);
        $('#DeleteModal').modal('show');

    });
  });
</script>
<?php include('includes/footer.php');?>
