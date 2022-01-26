<?php
  session_start();
  include('includes/header.php');
  include('includes/topbar.php');
  include('includes/sidebar.php');
  include('../db_connect.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Dasboard</li>
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
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
          </div>
         
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <?php
                  $query = "SELECT landlordID FROM landlord ORDER BY landlordID";
                  $query_run = mysqli_query($con, $query);
                  
                  $row = mysqli_num_rows($query_run);

                  echo '<h3>'.$row.'<sup style="font-size: 20px"></sup></h3>';
                ?>
                <p>Landlord</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-person"></i>
              </div>
              <a href="landlord.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php
                  $query = "SELECT tenantID FROM tenant ORDER BY tenantID";
                  $query_run = mysqli_query($con, $query);
                  
                  $row = mysqli_num_rows($query_run);

                  echo '<h3>'.$row.'<sup style="font-size: 20px"></sup></h3>';
                ?>
                <p>Tenant</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-people"></i>
              </div>
              <a href="tenant.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php
                  $query = "SELECT userID FROM users ORDER BY userID";
                  $query_run = mysqli_query($con, $query);
                  
                  $row = mysqli_num_rows($query_run);

                  echo '<h3>'.$row.'<sup style="font-size: 20px"></sup></h3>';
                ?>
                <p>Registered Users</p>  
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="registered.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <?php
                  $query = "SELECT houseID FROM houses ORDER BY houseID";
                  $query_run = mysqli_query($con, $query);
                  
                  $row = mysqli_num_rows($query_run);

                  echo '<h3>'.$row.'<sup style="font-size: 20px"></sup></h3>';
                ?>
                <p>Rental House</p>
              </div>
              <div class="icon">
                <i class="ion ion-home"></i>
              </div>
              <a href="manageHouse.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>



</div>


<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>