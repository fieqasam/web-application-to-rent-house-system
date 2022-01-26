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
    <title>Renew Contract</title>
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
<!-- Content Header (Page header) -->
<div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
         <h1 class="m-0 text-dark"> Renew Contract</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
             <li class="breadcrumb-item active">Renew Tenant Contract</li>
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
                       <h4 class="text-bold font-lg" >Renew Tenant Contract</h4>
                       <p style="color:grey;">you may update tenat contract if there any changes on the contract.</p>
                   </div>
               <!-- /.card-header -->
               <form action="code.php" method="post" enctype="multipart/form-data">
               <div class="modal-body">
               <?php
               include('../message.php');
               ?>
               
               <?php 
               if (isset($_GET['termID']))
               {
                 $termID = $_GET['termID'];
                 $query = "SELECT * FROM term t INNER JOIN tenantcheckin tc ON t.checkIn_ID = tc.checkIn_ID INNER JOIN tenant tn ON tn.tenantID = tc.tenantID WHERE termID='$termID' LIMIT 1";
                 $query_run = mysqli_query($con, $query);
                 
                 if (mysqli_num_rows($query_run) > 0) 
                 {
                   foreach($query_run as $row)
                   {
                     ?>
                       <div class="row">
                       <div class="col-md-6">
                         <div class="form-group">
                           <input type="hidden" name="termID" placeholder="ID" value="<?php echo $termID;?>">
                           <label for="">Tenant Name</label>
                           <input type="text" name="tenantName" value="<?php echo $row['fullName']; ?>" class="form-control" placeholder="">
                         </div>
                       </div>

                       <div class="col-md-6">
                         <div class="form-group">
                           <label for="">Monthly Rental(RM)</label>
                           <input type="decimal" name="monthlyPaid" value="<?php echo $row['monthlyPaid']; ?>" class="form-control" placeholder="">
                         </div>
                       </div>

                       <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Contract Duration (Month)</label>
                         <input type="number" name="duration" value="<?php echo $row['duration']; ?>" class="form-control" placeholder="">
                         </div>
                       </div>

                       <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Start Date</label>
                         <input type="date" name="startDate" value="<?php echo $row['startDate']; ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                         <label for="">End Date</label>
                         <input type="date" name="endDate" value="<?php echo $row['endDate']; ?>" class="form-control" placeholder="">
                         </div>
                       </div>

                       <div class="col-md-6">
                         <div class="form-group">
                         <label for="">Contract</label>
                           <input type="file" name="file" class="form-control" >
                           <div>
                           <input type="hidden" name="file_old" value="<?php echo $row['filename']; ?>" class="form-control" > 
                           </div>
                         </div>
                       </div>
                       </div>

                     <div class="modal-footer">
                      <button type="submit" name="update_term" class="btn btn-primary">Save</button>
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
</html>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?> 