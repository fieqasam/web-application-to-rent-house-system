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

<div class="content-wrapper">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Property</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
              <li class="breadcrumb-item active">Property
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
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Monthly Rental (RM)</label>
                      <input type="text" name="rentalPaid" value="<?php echo $row['monthlyPaid']; ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Deposit (RM)</label>
                      <input type="text" name="deposit" value="<?php echo $row['deposit']; ?>" class="form-control">
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
                      <label for="">Subject</label>
                      <input type="text" name="subject" class="form-control" value="Responses to Rental House Applications">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                    <label for="">Contract and Agreement</label>
                    <input type="file" name="attachment" value="" class="form-control" >
                    <p style="color:red;">** upload document  .pdf files only</p>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                    <label for="">Message</label>
                    <textarea name="message" class="form-control" rows="7" cols="50">Thank you for your inquiry about renting house for <?php echo $row['houseName']; ?>. Find attached herewith our rental house agreement, including the contract for the house. Please find the agreement on the attachment and read carefully. Once you are agree with the terms, please upload the signed contract in pdf format on our website.
                    
 Please do not hesitate to call me if you have further question.
                    </textarea>
                    </div>
                  </div>

                  <input type="hidden" name="houseID" value="<?php echo $row['houseID'] ?>">
                  <input type="hidden" name="landlordID" value="<?php echo $row['landlordID'] ?>">
                  <input type="hidden" name="landlordEmail" value="<?php echo $email ?>">
                  <input type="hidden" name="notifyID" value="<?php echo $row['id'] ?>">
                  <input type="hidden" name="tenantID" value="<?php echo $row['tenantID']; ?>">
                  </div>
                  
                <div class="modal-footer">
                  <button type="submit" name="sendEmail" class="btn btn-primary">Save</button>
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
<!-- Modal -->
</div>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?> 