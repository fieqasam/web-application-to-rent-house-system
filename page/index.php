<?php 
session_start();
include('header.php');
include('../db_connect.php');
?>
<div class="">
    
            <div id="slider" class="sl-slider-wrapper">

        <div class="sl-slider">
        
          <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-1"></div>
            </div>
          </div>
          
          <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-2"></div>
            </div>
          </div>
          
          <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-3"></div>
            </div>
          </div>
          
          <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-4"></div>
            </div>
          </div>
          
          <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-5"></div>
            </div>
          </div>
        </div><!-- /sl-slider -->



        <nav id="nav-dots" class="nav-dots">
          <span class="nav-dot-current"></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </nav>

      </div><!-- /slider-wrapper -->
</div>

<div class="banner-search">
  <div class="container"> 
    <!-- banner -->
    <h3>Search and Rent House</h3>
    <div class="searchbar">
      <div class="row">
        <div class="col-lg-6 col-sm-6">
          <form action="functions.php" method="post">
          <input type="text"  name="search" id="search" class="form-control" placeholder="Search of Properties">
           <div class="row">
            <div class="col-lg-3 col-sm-3 ">
              <select class="form-control">
                <option>Rent</option>
              </select>
            </div>
            <div class="col-lg-3 col-sm-4">
              <select class="form-control">
              <option>Price</option>
                <option>RM 500 - RM 600</option>
                <option>RM 600 - RM 700</option>
                <option>RM 700 - RM 800</option>
                <option>RM 800 - above</option>
              </select>
            </div>
            <div class="col-lg-3 col-sm-4">
            <select class="form-control">
                <option>Property</option>
              </select>
              </div>
              <div class="col-lg-3 col-sm-4">
              <input  type="submit" name="submit" class="btn btn-success" value="Search">
              </div>
          </div>
        </div>
          </form>
         
        <div class="col-lg-5 col-lg-offset-1 col-sm-6 ">
          <p>Join now and get updated with all the properties deals.</p>
         <a  class="btn btn-info" href="../signIn.php">Login</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- banner -->
<div class="container">
  <div class="properties-listing spacer"> <a href="rent.php" class="pull-right viewall">View All Listing</a>
    <h2>Featured Properties</h2>
    <div id="owl-example" class="owl-carousel">

      <?php 
      $query = "SELECT * FROM houses";
      $query_run = mysqli_query($con, $query);

      if (mysqli_num_rows($query_run) > 0) 
      {
        foreach ($query_run as $row) 
        {
          ?>
            <div class="properties">
            <div class="image-holder"><img src="../landlord/uploads/house/<?=$row['house_image1']?>" class="img-responsive" alt="properties"/>
              <div class="status sold"><?php echo $row['houseStatus']; ?></div>
            </div>
            <h4><a href="property-detail.php"><?php echo $row['houseName']; ?></a></h4>
            <p class="price">Price: RM <?php echo $row['monthlyPaid']; ?></p>
            <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?php echo $row['noRoom']; ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?php echo $row['livingRoom']; ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Toilet"><?php echo $row['noToilet']; ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><?php echo $row['kitchen']; ?></span> </div>
            <a class="btn btn-primary" href="property-detail.php?ID=<?php echo $row['houseID']; ?>">View Details</a>
          </div>
          <?php
        }
      }

      ?>
      
    </div>
  </div>
  <div class="spacer">
    <div class="row">
      <div class="col-lg-6 col-sm-9 recent-view">
        <h3>About Us</h3>
        <p>Rent house is a platform for the tenant for searching the rental houses easily and also landlord for ease management. The user will have a better experience for searching and managing the rental house.<br><a href="about.php">Learn More</a></p>
      
      </div>
      <div class="col-lg-5 col-lg-offset-1 col-sm-3 recommended">
        <h3>Recommended Properties</h3>
        <div id="myCarousel" class="carousel slide">
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            <li data-target="#myCarousel" data-slide-to="3" class=""></li>
          </ol>
          <!-- Carousel items -->
         
          <div class="carousel-inner">
            <div class="item active">
              <div class="row">
                <div class="col-lg-4"><img src="images/properties/1.jpg" class="img-responsive" alt="properties"/></div>
                <div class="col-lg-8">
                  <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                  <p class="price">$300,000</p>
                  <a href="property-detail.php" class="more">More Detail</a> </div>
              </div>
            </div>
            <?php 
            $query = "SELECT * FROM houses";
            $query_run = mysqli_query($con, $query);

            if (mysqli_num_rows($query_run)>0) 
            {
              foreach ($query_run as $row2) {
                ?>
              <div class="item">
              <div class="row">
                <div class="col-lg-4"><img src="../landlord/uploads/house/<?=$row2['house_image1']?>" class="img-responsive" alt="properties"/></div>
                <div class="col-lg-8">
                  <h5><a href="property-detail.php"><?php echo $row2['houseName']; ?></a></h5>
                  <p class="price"> RM <?php echo $row2['monthlyPaid']; ?></p>
                  <a href="property-detail.php?ID=<?php echo $row2['houseID']; ?>" class="more">More Detail</a> </div>
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
</div>
<?php include'footer.php';?>