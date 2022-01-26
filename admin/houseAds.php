<?php
session_start();
include('includes/header.php');
include('includes/sidebar.php');
include('includes/topbar.php');
include('../db_connect.php');
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

                
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Advertise House</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
              <li class="breadcrumb-item active">Add House Advertise</li>
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
                <div class="card">    
                <!-- /.card-header -->
                <form action="code.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                <?php
               include('../message.php');
               ?>
                <?php
                 $query_landlord="SELECT * FROM landlord";
                 $query_landlord_run = mysqli_query($con, $query_landlord);
                 $query_house="SELECT * FROM house";
                 $query_house_run = mysqli_query($con, $query_house);
                ?>
                  <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Landlord Name</label>
                    <select class="form-control"  name="landlordID" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                      <option value="" disabled selected>choose</option>
                      <?php while($row = mysqli_fetch_array($query_landlord_run)):;?>
                      <option value="<?php echo $row['landlordID']; ?>"><?php echo $row['name']; ?></option>
                    <?php endwhile; ?>   
                    </select>
                  </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">House Name</label>
                      <select class="form-control"  name="id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                      <option selected>choose</option>
                      <?php while($row2 = mysqli_fetch_array($query_house_run)):;?>
                      <option value="<?php echo $row2['id'];?>"><?php echo $row2['houseNo'];?></option>
                      <?php endwhile; ?> 
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                  <label for="">House Image 1</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" name="house_image1" required> 
                    </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                  <label for="">House Image 2</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" name="house_image2" required> 
                    </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                  <label for="">House Image 3</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" name="house_image3" required> 
                    </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                  <label for="">House Image 4</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" name="house_image4" required> 
                    </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                  <label for="">No of Bedrooms</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                    <input type="number" class="form-control" name="bedrooms" required> 
                    </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                  <label for="">No of Bathrooms</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                    <input type="number" class="form-control" name="bathroom" required> 
                    </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                  <label for="">Size</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                    <input type="number" class="form-control" name="houseSize" required> 
                    </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                  <label for="">No of Parking Lot</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                    <input type="number" class="form-control" name="parkingNo" required> 
                    </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                  <label for="">Facilities</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" name="facilities" required> 
                    </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Furnished</label>
                      <select class="form-control"  name="furnishedType" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                      <option selected>choose</option>
                      <option value="Fully Furnished">Fully Furnished</option>
                      <option value="Partially Furnished">Partially Furnished</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" name="addAdvertisement" class="btn btn-primary">Save</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
                
             </div>
            </div>
        </div>
     </div>
    </section>
</div>
</div>
</body>
</html>
<?php include('includes/script.php'); ?>
<!--script to delete user -->
<!--script to delete user -->
<script>
  $(document).ready(function(){
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        var userID = $(this).val();
        //console.log(userID);
        $('.delete_term_id').val(userID);
        $('#DeleteModal').modal('show');

    });
  });
</script>

<?php include('includes/footer.php'); ?> 