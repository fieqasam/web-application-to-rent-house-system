<?php 
session_start();
include'header.php';
include'../db_connect.php';
?>

<!-- banner -->
<div class="inside-banner">
  <div class="container"> 
    <span class="pull-right"><a href="#">Home</a> / Landlord</span>
    <h2>Landlord</h2>
</div>
</div>
<!-- banner -->
<div class="container">
<div class="spacer agents">

<div class="row">
  <div class="col-lg-8  col-lg-offset-2 col-sm-12">
      <?php 
        $query = "SELECT * FROM landlord INNER JOIN users ON landlord.userID = users.userID WHERE users.userID LIKE landlord.userID";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run)>0) 
        {
            foreach ($query_run as $row) 
            {
                ?>
                    <!-- agents -->
                         <div class="row">
                            <div class="col-lg-2 col-sm-2 "><a href="#"><img src="../admin/uploads/profile/<?=$row['profileImage']?>" class="img-responsive"  alt="agent name"></a></div>
                            <div class="col-lg-7 col-sm-7 "><h4><?php echo $row['name']; ?></h4><br>
                            <h6><?php echo $row['username']; ?></h6>
                            <h6><?php echo $row['address']; ?></h6>
                            </div>
                            <div class="col-lg-3 col-sm-3 "><span class="glyphicon glyphicon-envelope"></span> <?php echo $row['email']; ?><br>
                            <span class="glyphicon glyphicon-earphone"></span> <?php echo $row['contactNo']; ?></div>
                        </div>
                        <!-- agents -->
                <?php
            }
        }
      ?>
      
  </div>
</div>


</div>
</div>

<?php include'footer.php';?>