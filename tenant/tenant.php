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
<!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tenant.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- Main Content -->  
  <section class="content">
    <div class="container-fluid">
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
      <div class="row">
        
        <div class="col-md-10">
          <?php
          $query_house = mysqli_query($con, "SELECT * FROM rental INNER JOIN houses ON rental.houseID=houses.houseID WHERE tenantID='$userID'");

          if (mysqli_num_rows($query_house)> 0) {

            foreach ($query_house as $row) {
              ?>
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
             <p>You occupy house : <?php echo $row['houseName'] ?></p> 
           </div>
              <?php
            }
          }
          ?>
       
        </div>
      </div>
    </div>
  </section>

</div>
</body>
</html>

<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>

