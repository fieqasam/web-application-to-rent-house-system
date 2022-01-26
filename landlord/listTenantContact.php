<?php
session_start();
include('includes/header.php');
include('includes/sidebar.php');
include('includes/topbar.php');
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
    <title>List All Tenant's Contact</title>
</head>
<body>
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->

<div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
         <h1 class="m-0 text-dark">Listing Tenant's Contact</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
             <li class="breadcrumb-item active" >Listing Tenant's Contact</li>
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
                     <tr style="text-align:center">
                         <th>Tenant's Name</th>
                         <th>Contact's Name</th>
                         <th>Occupation</th>
                         <th>Nature of Relationship</th>
                         <th>Contact Number</th>
                         <th>Email</th>
                         <th>Address</th>
                     </tr>
                     </thead>
                     <tbody>
                     <?php
                       $query = "SELECT * FROM rental INNER JOIN contactinformation ON rental.tenantID = contactinformation.tenantID WHERE rental.landlordID='$userID'";
                       $query_run = mysqli_query($con, $query);

                       if (mysqli_num_rows($query_run) > 0) 
                       {
                        //loop every iteration until last element
                        //for displaying all data once new data insert
                        foreach($query_run as $row)
                        {
                          //displaying all data in db
                          ?>
                        <tr style="text-align:center">
                         <td><?php echo $row['tenantName']; ?></td>
                         <td><?php echo $row['contactName']; ?></td>
                         <td><?php echo $row['occupation']; ?></td>
                         <td><?php echo $row['relationContact']; ?></td>
                         <td><?php echo $row['contactNo']; ?></td>
                         <td><?php echo $row['email']; ?></td>
                         <td><?php echo $row['address']; ?></td>  
                        </tr>
                        <?php
                        }
                       }
                       else
                       {
                         ?>
                         <tr>
                         <?php  echo "<script>alert('No record found in the database.');</script>"; ?>
                           <td>No record found in the database.</td>
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
   </section>
</div>

</div>
</body>
</html>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?> 