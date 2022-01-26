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
    $sql_get= mysqli_query($con, "SELECT * FROM notifications INNER JOIN users ON notifications.tenantID=users.userID WHERE status=0 AND landlordID='$userID'");
    //count num of rows
    $count = mysqli_num_rows($sql_get);
    ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu for house application -->
        <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-envelope"></i>
          <span class="badge badge-danger navbar-badge"><?php echo $count ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <?php
            $query_message= mysqli_query($con, "SELECT * FROM notifications INNER JOIN users ON notifications.tenantID=users.userID WHERE status=0 AND landlordID='$userID'");
            if (mysqli_num_rows($query_message)> 0) 
            {
              while ($row4 = mysqli_fetch_assoc($query_message)) {
                ?>
                <!-- Message Start -->
                <a href="responsewishlist.php?id=<?php echo $row4['id'] ?>" class="dropdown-item">
                <div class="media">
                  <img src="../admin/uploads/profile/<?=$row4['profileImage']?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      <?php echo $row4['senderName'] ?>
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm"><?php echo $row4['message'] ?></p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo $row4['date'] ?></p>
                  </div>
                </div>
                
                <!-- Message End -->
              </a>
              <?php
              }
            }
            else {
              echo '<a class="dropdown-item text-danger font-weight-bold" href="#"><i class="fas fa-frown-open"></i> Sorry! No Message</a>';
            }
          ?>
          <div class="dropdown-divider"></div>
          <a href="responsewishlist.php" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
    <!-- notifications Dropdown Menu for checklist responses -->
    <?php
    $sql_rep= mysqli_query($con, "SELECT * FROM reponses WHERE status='pending' AND landlordID='$userID'");
    //count num of rows
    $count_rep = mysqli_num_rows($sql_rep);
    ?>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?php echo $count_rep ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo $count_rep ?> Responses</span>
          <?php while($result = mysqli_fetch_array($sql_rep)):;?>
          <div class="dropdown-divider"></div>
          <a href="tenantCheckOut.php" class="dropdown-item">
            <i class="fas fa-file-alt mr-2"></i><?php echo $result['tenantName'] ?>
            <span class="float-right text-muted text-sm"><?php echo $result['dateSent'] ?></span>
          </a>
          <?php endwhile; ?>
          <div class="dropdown-divider"></div>
          <a href="tenantCheckOut.php" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    <!-- Notifications Dropdown Menu -->

   <!-- user information Dropdown Menu -->
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
        <a class="dropdown-item" href="landlordProfile.php"> My Profile</a>
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
