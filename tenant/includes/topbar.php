<?php include('../db_connect.php');
error_reporting(0);
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
  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control  form-control-navbar " type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    <?php
    $sql_get= mysqli_query($con, "SELECT * FROM complaint WHERE statusComplaint=2 AND tenantID='$userID'");
    //count num of rows
    $count = mysqli_num_rows($sql_get);
    ?>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?php echo $count ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo $count ?> Notifications</span>
          <div class="dropdown-divider"></div>
          <?php while($result = mysqli_fetch_array($sql_get)):;?>
          <div class="dropdown-divider"></div>
          <a href="send_msg.php?complaintID=<?php echo $result['complaintID']; ?>" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?php echo $result['remarks'] ?>
            <span class="float-right text-muted text-sm"><?php echo $result['complaintDate'] ?></span>
          </a>    
          <div class="dropdown-divider"></div> 
          <?php endwhile; ?>   
          <a href="send_msg.php" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    <li class="navbar-item">
      <div class="dropdown">
      <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false"> 
        <?php
        if (isset($_SESSION['auth'])) {
          echo $_SESSION['auth_user']['username'];
        }
        else
        {
          echo "Not Logged In";
        }
          
         ?>
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="../page/index.php"> Home</a>
        <a class="dropdown-item" href="tenantInfo.php"> My Profile</a>
        <form action="code.php" method="POST">
          <button type="submit" name="logoutBtn" class="dropdown-item">Logout</button>
        </form>
        </div>
      </div>
    </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

</body>
</html>
