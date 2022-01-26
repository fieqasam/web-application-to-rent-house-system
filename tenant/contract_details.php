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
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Lease Agreement</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tenant.php">Home</a></li>
              <li class="breadcrumb-item active">Lease Agreement</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!--Main content -->
 <!-- /.content-header -->
 <section class="content">
        <div class="container">
            <div class="row">
             <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class=" text-bold font-lg" >Lease Agreement</h3>
                        <p style="color:grey;">You may view the lease agreement with the landlord</p>
                    </div>
                    
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        <?php
                        include('../message.php');
                        ?>

                          <?php
                           $query = "SELECT * FROM rental WHERE tenantID='$userID'";
                           $query_run = mysqli_query($con, $query);
                           if (mysqli_num_rows($query_run)>0) {
                             foreach ($query_run as $row) {
                              ?>
                              <div class="container">
                              <div class="row">
                              <embed src="../landlord/uploads/contract/<?=$row['agreement']; ?>" type="application/pdf" width="100%" height="600px"/>
                              </div>
                              </div>
                            <?php
                             }
                           }
                          ?>                                         
                </div>
             </div>
            </div>
        </div>
     </div>
    </section>


</div>
<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>