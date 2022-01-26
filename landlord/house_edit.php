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
                       <h4 class="text-bold font-lg" >Update House Information</h4>
                       <p style="color:grey;">you may update the information in the house registered.</p>
                   </div>
               <!-- /.card-header -->
               <form action="code.php" method="post" enctype="multipart/form-data">
               <div class="modal-body">
               <?php
               include('../message.php');
               ?>
               <?php 
               if (isset($_GET['houseID']))
               {
                 $houseID = $_GET['houseID'];
                 $query = "SELECT * FROM houses WHERE houseID='$houseID' LIMIT 1";
                 $query_run = mysqli_query($con, $query);

                 if (mysqli_num_rows($query_run) > 0) 
                 {
                   foreach($query_run as $row)
                   {
                     ?>
                       <div class="row">
                       <div class="col-md-12">
                         <div class="form-group">
                           <input type="hidden" name="houseID" placeholder="houseID" value="<?php echo $houseID;?>">
                           <label for="">House Name</label>
                           <input type="text" name="houseName" value="<?php echo $row['houseName'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Address 1</label>
                          <input type="text" name="address1" class="form-control"  value="<?php echo $row['address1'] ?>" placeholder="address 1">
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for=""> Address 2</label>
                        <input type="text" name="address2" class="form-control" value="<?php echo $row['address2'] ?>" placeholder="address 2">
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                        <label for="">Postcode</label>
                        <input type="number" name="postcode" class="form-control" value="<?php echo $row['postcode'] ?>" placeholder="">
                        </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                          <label for="">District</label>
                          <input type="text" name="district" class="form-control" value="<?php echo $row['district'] ?>" placeholder="">
                          </div>
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">
                          <label for="">State</label>
                          <input type="text" name="state" class="form-control" value="<?php echo $row['state'] ?>" placeholder="">
                          </div>
                          </div>
                       <div class="col-md-6">
                         <div class="form-group">
                           <label for="">Monthly Rental(RM)</label>
                           <input type="decimal" name="monthlyPaid" value="<?php echo $row['monthlyPaid'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                           <label for="">Negotiable</label>
                           <select class="form-control"  name="negotiable"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                           <option selected disabled><?php echo $row['negotiable'] ?></option>
                           <option value="Yes">Yes</option>
                           <option value="No">No</option>
                         </select>
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                           <label for="">Deposit</label>
                           <input type="decimal" name="deposit" value="<?php echo $row['deposit'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                           <label for="">Description</label>
                           <input type="text" name="description" value="<?php echo $row['description'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                         <?php 
                          $query_category="SELECT * FROM housecategory";
                          $query_category_run = mysqli_query($con, $query_category);
                        ?>
                         <label for="">Category</label>
                         <select class="form-control"  name="category"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                           <option selected ><?php echo $row['category'] ?></option>
                           <?php while($row1 = mysqli_fetch_array($query_category_run)):;?>
                          <option value="<?php echo $row1['categoryName'];?>"><?php echo $row1['categoryName'];?></option>
                          <?php endwhile; ?> 
                         </select>
                         </div>
                       </div>
                      
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="">Size</label>
                           <input type="text" name="size" value="<?php echo $row['size'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="">Number of Room</label>
                           <input type="text" name="noRoom" value="<?php echo $row['noRoom'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="">Number of Toilet</label>
                           <input type="text" name="noToilet" value="<?php echo $row['noToilet'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="">Floor Type</label>
                           <input type="text" name="floorType" value="<?php echo $row['floorType'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="">Availability of air-conditioner</label>
                           <input type="text" name="airCond" value="<?php echo $row['airCond'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="">Availability of Wifi</label>
                           <input type="text" name="wifi" value="<?php echo $row['wifi'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="">Furniture</label>
                           <input type="text" name="furniture" value="<?php echo $row['furniture'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="">Gate</label>
                           <input type="text" name="gate" value="<?php echo $row['gate'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="">CCTV</label>
                           <input type="text" name="cctv" value="<?php echo $row['cctv'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="">gate and guarded</label>
                           <input type="text" name="gateNguarded" value="<?php echo $row['gateNguarded'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="">Availability of Kitchen</label>
                           <input type="text" name="kitchen" value="<?php echo $row['kitchen'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                           <label for="">Type of Ktchen</label>
                           <input type="text" name="typeKitchen" value="<?php echo $row['typeKitchen'] ?>" class="form-control" placeholder="">
                         </div>
                       </div>
                    
                     <div class="modal-footer">
                      <button type="submit" name="update_House" class="btn btn-primary">Save</button>
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