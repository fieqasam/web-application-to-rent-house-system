<?php
session_start();
include('includes/header.php');
include('includes/sidebar.php');
include('includes/topbar.php');
include('../db_connect.php');
?>
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
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
<div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
         <h1 class="m-0 text-dark"> Register Rent House</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
             <li class="breadcrumb-item active">Rent House </li>
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
               <div class="card">
                   <div class="card-header">
                       <h4 class="text-bold font-lg" >Update Rental Information</h4>
                       <p style="color:grey;">you may update the rental information here.</p>
                   </div>
               <!-- /.card-header -->
               <form action="code.php" method="post" enctype="multipart/form-data">
               <div class="modal-body">
               <?php
               include('../message.php');
               ?>
               <?php 
               if (isset($_GET['paymentID']))
               {
                 $paymentID = $_GET['paymentID'];
                 $query = "SELECT * FROM payment INNER JOIN rental ON payment.tenantID=rental.tenantID  INNER JOIN houses ON rental.houseID=houses.houseID WHERE payment.paymentID='$paymentID'";
                 $query_run = mysqli_query($con, $query);

                 if (mysqli_num_rows($query_run) > 0) 
                 {
                   foreach($query_run as $row)
                   {
                     ?>
                       <div class="row">
                       <div class="col-md-6">
                         <div class="form-group">
                           <label for="">Payment No</label>
                           <input type="text" class="form-control" name="paymentID" placeholder="" value="<?php echo $paymentID;?>">
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                           <label for="">Tenant Name</label>
                           <input type="text" name="tenantName" value="<?php echo $row['tenantName'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                           <label for="">House Name</label>
                           <input type="text" name="houseName" value="<?php echo $row['houseName'] ?>" class="form-control" placeholder="">
                         </div>
                     </div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for=""> Status Payment</label>
                        <select class="form-control" name="statusPayment" class="from-control">
                            <option selected disabled>Choose</option>
                            <option value="Paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                        </div>
                        </div>
                        
                     <div class="modal-footer">
                      <button type="submit" name="updatePaymentStatus" class="btn btn-primary">Submit</button>
                      <button type="reset" class="btn btn-secondary" value="Reset">Cancel</button>
                     </div>
                     <?php
                   }
                 }
                 else
                 {
                   echo "<h4>No record found!</h4>";
                 }
               }

               ?>
               
               </form>

            </div>
           </div>
       </div>
    </div>
   </section>

</div>
</body>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?> 