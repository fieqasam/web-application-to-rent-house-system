<?php include('db_connect.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>RentHouse</title>
<meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

 	<link rel="stylesheet" href="assetss/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="assetss/style.css"/>
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="assetss/bootstrap/js/bootstrap.js"></script>
  <script src="assetss/script.js"></script>



<!-- Owl stylesheet -->
<link rel="stylesheet" href="assetss/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="assetss/owl-carousel/owl.theme.css">
<script src="assetss/owl-carousel/owl.carousel.js"></script>
<!-- Owl stylesheet -->


<!-- slitslider -->
    <link rel="stylesheet" type="text/css" href="assetss/slitslider/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assetss/slitslider/css/custom.css" />
    <script type="text/javascript" src="assetss/slitslider/js/modernizr.custom.79639.js"></script>
    <script type="text/javascript" src="assetss/slitslider/js/jquery.ba-cond.min.js"></script>
    <script type="text/javascript" src="assetss/slitslider/js/jquery.slitslider.js"></script>
<!-- slitslider -->

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

<!-- Header Starts -->
<div class="navbar-wrapper">

        <div class="navbar-inverse" role="navigation">
          <div class="container">
            <div class="navbar-header">


              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

            </div>


            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="page/index.php">Home</a></li>
               <li><a href="page/rent.php">Rent</a></li>
                <li><a href="page/condo.php">Condos</a></li>
                <li><a href="page/agents.php">Find Landlord</a></li>         
                <li><a href="page/news.php">News</a></li>
                <li><a href="signIn.php">
                <?php
                  if (isset($_SESSION['auth'])) {
                    echo $_SESSION['auth_user']['username'];
                  }
                  else
                  {
                    echo "Login";
                  }
                    
                  ?>
                </a>
              </li>

              </ul>
            </div>
            <!-- #Nav Ends -->

          </div>
        </div>

    </div>
<!-- #Header Starts -->

<div class="container">

<!-- Header Starts -->
<div class="header">
<a href="index.php"><img src="images/angeloo.png" alt="Realestate"></a>
</div>
<!-- #Header Starts -->
</div>