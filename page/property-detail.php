<?php
session_start();
include('header.php');
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RENT HOUSE</title>
</head>
<body>
  <!-- banner -->
<div class="inside-banner">
  <div class="container"> 
    <span class="pull-right"><a href="#">Home</a> / Rent</span>
    <h2>Rent</h2>
</div>
</div>
<!-- banner -->

<div class="container">
<div class="properties-listing spacer">

<div class="row">
<div class="col-lg-3 col-sm-4 hidden-xs">

<div class="hot-properties hidden-xs">
<h4>Hot Properties</h4>
<?php 
    $query = "SELECT * FROM houses LIMIT 4";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) 
    {
      foreach ($query_run as $row) 
      {
        ?>
        <div class="row">
                <div class="col-lg-4 col-sm-5"><img src="../landlord/uploads/house/<?=$row['house_image1']?>" class="img-responsive img-circle" alt="properties"/></div>
                <div class="col-lg-8 col-sm-7">
                  <h5><a href="property-detail.php"><?php echo $row['houseName']; ?></a></h5>
                  <p class="price">RM <?php echo $row['monthlyPaid']; ?></p> </div>
              </div>
        <?php
      }
    }
  ?>
</div>

</div>
<!-- property detail section -->
<?php 
if (isset($_GET['ID'])) 
{
  $houseID = $_GET['ID'];
  $query = "SELECT * FROM houses WHERE houseID='$houseID' LIMIT 1";
  $query_house = mysqli_query($con, $query);

  if (mysqli_num_rows($query_house) > 0) 
  {
    foreach ($query_house as $row2) 
    {
      ?>
      <div class="col-lg-9 col-sm-8 ">
      <h2><?php echo $row2['houseName']; ?></h2>
      <div class="row">
      <div class="col-lg-8">
      <div class="property-images">
    <!-- Slider Starts -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators hidden-xs">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
        <li data-target="#myCarousel" data-slide-to="3" class=""></li>
      </ol>
      <div class="carousel-inner">

        <!-- Item 1 -->
        <div class="item active">
          <img src="../landlord/uploads/house/<?=$row2['house_image1']?>" class="properties" alt="properties" />
        </div>
        <!-- #Item 1 -->

        <!-- Item 2 -->
        <div class="item">
          <img src="../landlord/uploads/house/<?=$row2['house_image2']?>" class="properties" alt="properties" />
         
        </div>
        <!-- #Item 2 -->

        <!-- Item 3 -->
         <div class="item">
          <img src="../landlord/uploads/house/<?=$row2['house_image3']?>" class="properties" alt="properties" />
        </div>
        <!-- #Item 3 -->

        <!-- Item 4 -->
        <div class="item ">
          <img src="../landlord/uploads/house/<?=$row2['house_image4']?>" class="properties" alt="properties" />
          
        </div>
        <!-- # Item 4 -->
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
<!-- #Slider Ends -->

  </div>
  <!-- Display property details -->
<div class="spacer"><h4><span class="glyphicon glyphicon-th-list"></span> Property Detail</h4>
  <table class="table table-borderless">
    <thead>
      <tbody>
        <tr>
        <td><span class="glyphicon glyphicon-ok-sign"></span> House Area: <?php echo $row2['size']; ?> sqft</td>
        <td><span class="glyphicon glyphicon-ok-sign"></span> Type of Floor: <?php echo $row2['floorType']; ?></td>
        <td><span class="glyphicon glyphicon-ok-sign"></span> Type of kitchen: <?php echo $row2['typeKitchen']; ?></td>
        </tr>
        <tr>
          <td><span class="glyphicon glyphicon-ok-sign"></span> Furniture: <?php echo $row2['furniture']; ?> </td>
          <td><span class="glyphicon glyphicon-ok-sign"></span> Gate: <?php echo $row2['gate']; ?></td>
          <td> <span class="glyphicon glyphicon-ok-sign"></span> Wifi-availability: <?php echo $row2['wifi']; ?> </td>
        </tr>
        <tr>
          <td><span class="glyphicon glyphicon-ok-sign"></span> CCTV: <?php echo $row2['cctv']; ?></td>
          <td><span class="glyphicon glyphicon-ok-sign"></span> Gate and Guarded: <?php echo $row2['gateNguarded']; ?></td>
          <td></td>
        </tr>     
      </tbody>
    </thead>
  </table>
  <!-- Display rental information -->
  <div class="spacer"><h4><span class="glyphicon glyphicon-th-list"></span> Rental Detail</h4></div>
  <table class="table table-borderless">
      <thead>
        <tbody>
          <tr>
            <td><span class="glyphicon glyphicon-usd"></span> Rental per Month: RM <?php echo $row2['monthlyPaid']; ?></td>
          </tr>
          <tr>
          <td><span class="glyphicon glyphicon-usd"></span> Deposit: RM <?php echo $row2['deposit']; ?></td>
          </tr>
          <tr>
          <td><span class="glyphicon glyphicon-pushpin"></span> Description: <?php echo $row2['description']; ?></td>
          </tr>
        </tbody>
      </thead>
  </table>
  </div>
<!-- mark location on google maps-->
  <div><h4><span class="glyphicon glyphicon-map-marker"></span> Location</h4>
  <div class="well">
    <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAw_P5obW-hqczKo9toyUdTjV2FNDrQ_8g&q= <?php echo $row2['address1']; ?>, <?php echo $row2['district']; ?>, <?php echo $row2['state']; ?>" width="600" height="450" style="border:0;"width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" allowfullscreen="" loading="lazy"></iframe>
  </div>
  </div>

  </div>
  <div class="col-lg-4">
  <div class="col-lg-12  col-sm-6">

  <div class="property-info">
  <p class="price">RM <?php echo $row2['monthlyPaid']; ?></p>
  <p class="area"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $row2['address1']; ?>, <?php echo $row2['district']; ?>, <?php echo $row2['state']; ?></p>
  </div>

  <h6><span class="glyphicon glyphicon-home"></span> Availabilty</h6>
    <div class="listing-detail">
    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?php echo $row2['noRoom']; ?></span> 
    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?php echo $row2['livingRoom']; ?></span> 
    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><?php echo $row2['kitchen']; ?></span> 
    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Toilet"><?php echo $row2['noToilet']; ?></span> 
    <span data-toggle="tooltip" data-placement="bottom" data-original-title="Air-Conditioner"><?php echo $row2['airCond']; ?></span>
    </div>
<!-- Right side bar for landlord details -->
  <div class="profile">
  <span class="glyphicon glyphicon-user"></span> Landlord Details
  <?php 
    $query_landlord="SELECT * FROM houses INNER JOIN Landlord ON houses.userID=Landlord.userID WHERE houses.houseID LIKE $houseID LIMIT 1";
    $query_landlod_run = mysqli_query($con, $query_landlord);
  ?>
   <?php while($row3 = mysqli_fetch_array($query_landlod_run)):;?>
  <p><?php echo $row3['name']; ?><br><?php echo $row3['email']; ?><br><?php echo $row3['contactNo']; ?></p>
  </div>
</div>
<!-- right side bar for message landlord  -->
<div class="col-lg-12 col-sm-6 ">
<div class="enquiry">
  <h6><span class="glyphicon glyphicon-envelope"></span> Post Enquiry</h6>
  <form role="form" action="email.php" method="post" enctype="multipart/form-data">
      <input type="hidden" class="form-control" name="recipient" value="<?php echo $row3['email']; ?>" >
      <input type="text" class="form-control" name="subject" value="Rental Inquiry"/>
      <input type="text" class="form-control" name="senderName" placeholder="Full Name"/>
      <input type="text" class="form-control" name="senderEmail" placeholder="you@email.com"/>
      <input type="text" class="form-control" name="senderNumber" placeholder="your number"/>
      <textarea rows="6" class="form-control" name="message" placeholder="Whats on your mind?"></textarea>
      <input type="hidden" class="form-control" name="landlordID" value="<?php echo $row3['userID']; ?>" >
      <input type="hidden" class="form-control" name="houseID" value="<?php echo $row3['houseID']; ?>" >
      <input type="hidden" class="form-control" name="tenantID" value="<?php echo $userID ?>">
      <button type="submit" class="btn btn-primary" name="submit">Wish To Rent</button>
      <?php endwhile; ?> 
  </form>
 </div>         
</div>

  </div>
</div>
</div>
   <?php
    }
  }

}
?>

</div>
</div>
</div>
</body>
</html>

<?php include'footer.php';?>