<?php
session_start();
include('includes/header.php');
include('includes/sidebar.php');
include('includes/topbar.php');
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
    <div class="content-wrapper">
        <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Reject Response</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
              <li class="breadcrumb-item active">Reject Response
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
               <?php
                    if (isset($_GET['id'])) {

                    $id  = $_GET['id'];
                    $query = "SELECT * FROM notifications INNER JOIN houses ON notifications.houseID=houses.houseID WHERE id LIKE $id LIMIT 1";
                    $query_run = mysqli_query($con,$query);

                    if (mysqli_num_rows($query_run) > 0) {
                     foreach ($query_run as $row) 
                    {
                        ?>
                        <div class="card-header">
                            <div class="upload-profile-image d-flex text-center p-1 mt-1">
                                <div class="alb">
                                  <img class="img rounded-circle" src="../landlord/uploads/house/<?=$row['house_image1']; ?>" style="width: 80px; height: 80px;" >
                                </div>
                                <ul>
                                    <ol><h4 class="text-center text-bold">Applied For <?php echo $row['houseName']; ?></h4></ol>
                                </ul>
                                </div>
                            </div>
                        </div>
                         <?php
                        
                ?>
      <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <form action="code.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="row">
                  <div class="col-md-12">
                  <div class="form-group">
                  <label for="">Tenant Name</label>
                  <input type="text" name="tenantName" value=" <?php echo $row['senderName']; ?>" class="form-control">
                  </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Tenant Email</label>
                      <input type="email" name="tenantEmail" value=" <?php echo $row['senderEmail']; ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Tenant Contact Number</label>
                      <input type="text" name="tenantNumber" value=" <?php echo $row['senderNumber']; ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Subject</label>
                      <input type="text" name="subject" class="form-control" value="Decline an Application">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                    <label for="">Message</label>
                    <textarea name="message" class="form-control" rows="7" cols="50">Dear Mr/Mrs <?php echo $row['senderName']; ?>,
          Thank you for taking the time to apply for my property on <?php echo $row['houseName'] ?>. 
          After carefully reviewing all the applications, I am sorry to inform you that we have decided to go with another application. 
          Your application was very much appreciated, and if the approved application falls through I hope that you don't mind if I get in contact with you.
          Thank you again for your application.
                      
          Regards,
          Landlord, <?php echo $row['houseName']; ?>
                    </textarea>
                    </div>
                  </div>

                  </div>
                <div class="modal-footer">
                  <button type="submit" name="rejectEmail" class="btn btn-primary">Send</button>
                  <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
                </form>
                    
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
    </div>
   </section>
    </div>
</body>
</html>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?> 