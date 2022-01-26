<?php
  session_start();
  include('includes/header.php');
  include('includes/topbar.php');
  include('includes/sidebar.php');
  include('../db_connect.php');
?>
  <style>
        
        .alb{
            width: 100px;
            height:100px;
            padding: 5px;

        }
        .alb img{
            width: 100%;
            height: 100%;
        }
    </style>

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

 <!-- Delete user -->
 <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Tenant</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="code.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="delete_id" class="delete_house_id">
      <p>
        Are you sure you want to delete this data?
      </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="DeleteTenantbtn" class="btn btn-primary">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete user -->

<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Listing Rent House</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
              <li class="breadcrumb-item active">Listing Registered Rent House</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
    <div class="container">
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
          <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
              <div style="overflow-x:auto;">
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>House Name</th>
                        <th>Location</th>
                        <th>Facilities</th>
                        <th>Rental Information</th>
                        <th>House Images</th>
                        <th>Update</th>
                        <th>Delete</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query = "SELECT * FROM houses WHERE userID LIKE $userID";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) 
                        {
                         //loop every iteration until last element
                         //for displaying all data once new data insert
                         foreach($query_run as $row)
                         {
                           //displaying all data in db
                           ?>
                         <tr>
                          <td  width="20%"><?php echo $row['houseName']; ?></td>
                          <td><?php echo $row['address1']; ?>,<?php echo $row['address2']; ?>,<?php echo $row['postcode']; ?>,<?php echo $row['district']; ?>,<?php echo $row['state']; ?></td>
                          <td width="60%">
                          <ul class="font-ubuntu navbar-nav">
                            <li>Total Bedroom: <span><?php echo isset( $row['noRoom']) ? $row['noRoom'] :''; ?></span></li>
                            <li>Total Toilet: <span><?php echo isset( $row['noToilet']) ? $row['noToilet'] :''; ?></span></li>
                            <li>Type of Floor: <span><?php echo isset( $row['floorType']) ? $row['floorType'] :''; ?></span></li>
                            <li>Availability Living Room: <span><?php echo isset( $row['livingRoom']) ? $row['livingRoom'] :''; ?></span></li>
                            <li>Availability Air-Cond: <span><?php echo isset( $row['airCond']) ? $row['airCond'] :''; ?></span></li>
                            <li>Availability of Kitchen: <span><?php echo isset( $row['kitchen']) ? $row['kitchen'] :''; ?></span></li>
                            <li>Type Kitchen: <span><?php echo isset( $row['typeKitchen']) ? $row['typeKitchen'] :''; ?></span></li>
                            <li>Wifi-availability: <span><?php echo isset( $row['wifi']) ? $row['wifi'] :''; ?></span></li>
                            <li>Furniture: <span><?php echo isset( $row['furniture']) ? $row['furniture'] :''; ?></span></li>
                            <li>Gate: <span><?php echo isset( $row['gate']) ? $row['gate'] :''; ?></span></li>
                            <li>Availability CCTV: <span><?php echo isset( $row['cctv']) ? $row['cctv'] :''; ?></span></li>
                            <li>Gate and Guarded: <span><?php echo isset( $row['gateNguarded']) ? $row['gateNguarded'] :''; ?></span></li>
                          </td>
                          <td width="50%">
                            <ul class="font-ubuntu navbar-nav">
                            <li>Rental Price: RM <span><?php echo isset( $row['monthlyPaid']) ? $row['monthlyPaid'] :''; ?></span></li>
                            <li>Deposit: RM <span><?php echo isset( $row['deposit']) ? $row['deposit'] :''; ?></span></li>
                            <li>Description: <span><?php echo isset( $row['description']) ? $row['description'] :''; ?></span></li>
                            </ul>
                          </td>
                          <td>
                            <div class="alb">
                            <img src="../landlord/uploads/house/<?=$row['house_image1']?>" >
                            </div>
                            <div class="alb">
                            <img src="../landlord/uploads/house/<?=$row['house_image2']?>" >
                            </div>
                            <div class="alb">
                            <img src="../landlord/uploads/house/<?=$row['house_image3']?>" >
                            </div>
                            <div class="alb">
                            <img src="../landlord/uploads/house/<?=$row['house_image4']?>" >
                            </div>
                          </td>
                          <td>
                          <a href="house_edit.php?houseID=<?php echo $row['houseID']; ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                          </td>
                          <td> 
                          <form action="code.php" method="POST">
                            <input type="hidden" name="delete_id" value="<?php echo $row['houseID']; ?>">
                            <input type="hidden" name="delete_house_image" value="<?php echo $row['house_image1']; ?>">
                            <input type="hidden" name="delete_house_image" value="<?php echo $row['house_image2']; ?>">
                            <input type="hidden" name="delete_house_image" value="<?php echo $row['house_image3']; ?>">
                            <input type="hidden" name="delete_house_image" value="<?php echo $row['house_image4']; ?>">
                            <button type="submit" name="delete_house" class="btn btn-danger"><i class="nav-icon fas fa-trash-alt"></i></button>
                          </form> 
                          </td>
                      </tr>
                           <?php
                         }
                        }
                        else
                        {
                          ?>
                          <tr>
                            <td>No record found.</td>
                          </tr>
                          <?php
                        }
                      ?>
                     
                      </tbody>
                  </table>   
                  </div> 
              </div>
          </div>
        </div>
      </div>
    </div>
    </section>
</div>
</div>

<?php include('includes/script.php');?>
<!--live check email already exists-->
<script>
  $(document).ready(function() {
    $('.email_id').keyup(function (e) {
        var email = $('.email_id').val();
        // console.log(email);
        $.ajax({
          type:"POST";
          url:"code.php";
          data: {
            'check_Emailbtn':1,
            'email':email,
          },
          success: function (response) {
           // console.log(response);
           $('.email_error').text(response);
          }
        });
    });
  });
</script>
  <!--script to delete user -->
<script>
  $(document).ready(function(){
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        var userID = $(this).val();
        //console.log(userID);
        $('.delete_user_id').val(userID);
        $('#DeleteModal').modal('show');

    });
  });
</script>
<?php include('includes/footer.php');?>