<?php
session_start();
include('header.php');
include('../db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>RENT HOUSE</title>
</head>
<body>

<!-- banner -->
<div class="inside-banner">
  <div class="container"> 
    <span class="pull-right"><a href="index.php">Home</a> / Rent</span>
    <h2> All Rental Properties</h2>
</div>
</div>
<!-- banner -->

<div class="container">
<div class="properties-listing spacer">

<div class="row">
<div class="col-lg-3 col-sm-4 ">

  <div class="search-form"><h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
    <form action="functions.php" method="post">
    <input type="text"  name="search" id="search" class="form-control" placeholder="Search of Properties">
    <div class="row">
            <div class="col-lg-5">
              <select class="form-control">
                <option>Rent</option>
              </select>
            </div>
            <div class="col-lg-7">
              <select class="form-control">
                <option>Price</option>
                <option>RM 500 - RM 600</option>
                <option>RM 600 - RM 700</option>
                <option>RM 700 - RM 800</option>
                <option>RM 800 - above</option>
              </select>
            </div>
          </div>

          <div class="row">
          <div class="col-lg-12">
              <select class="form-control">
                <option>Property Type</option>
                <option>Terrace</option>
                <option>Double-storey</option>
                <option>Apartment</option>
                <option>Condominium</option>
              </select>
              </div>
          </div>
          <input  type="submit" name="submit" class="btn btn-primary" value="Find Now">
    </form>
 
  </div>



<div class="hot-properties hidden-xs">
<!--Hot Properties-->
</div>

</div>

<div class="col-lg-9 col-sm-8">
<div class="sortby clearfix">
<div class="pull-left result">Showing: 1 of 100 </div>
  <div class="pull-right">
  <select class="form-control">
  <option>Sort by</option>
  <option>Price: Low to High</option>
  <option>Price: High to Low</option>
</select></div>

</div>
<div class="row">
    <?php 
        $query = "SELECT * FROM houses WHERE category != 'Condominium'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) 
        {
           foreach ($query_run as $row) 
           {
               ?>
                <!-- properties -->
                <div class="col-lg-4 col-sm-6">
                <div class="properties">
                    <div class="image-holder"><img src="../landlord/uploads/house/<?=$row['house_image1']?>" class="img-responsive" alt="properties">
                    <div class="status sold"><?php echo $row['houseStatus']; ?></div>
                    </div>
                    <h4><a href="property-detail.php?ID=<?php echo $row['houseID']; ?>"></a></h4><?php echo $row['houseName']; ?>
                    <p class="price">Price:RM <?php echo $row['monthlyPaid']; ?></p>
                    <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?php echo $row['noRoom']; ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?php echo $row['livingRoom']; ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Toilet"><?php echo $row['noToilet']; ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><?php echo $row['kitchen']; ?></span> </div>
                    <a class="btn btn-primary" href="property-detail.php?ID=<?php echo $row['houseID']; ?>">View Details</a>
                </div>
                </div>
                <!-- properties -->

               <?php
           }
        }
    ?>
</div>
      <div class="center">
<ul class="pagination">
          <li><a href="#">«</a></li>
          <li><a href="rent.php">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#">»</a></li>
        </ul>
</div>

</div>
</div>
</div>
</div>
</div>
<?php include'footer.php';?>
</body>
</html>