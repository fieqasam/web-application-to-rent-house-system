<?php
  session_start();
  include('includes/header.php');
  include('includes/topbar.php');
  include('includes/sidebar.php');
  include('../db_connect.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
              <li class="breadcrumb-item active">Update User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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
    <!-- /.content-header -->
    <section class="content">
       <div class="container">
           <div class="row">
            <div class="col-md-12">
               <div class="card">
                   <div class="card-header">
                       <h3 class="card-title text-bold font-lg" >Update User
                       </h3>
                       <a href="admin.php" class="btn btn-danger btn-sm float-right">Back</a>
                   </div>
               <!-- /.card-header -->
               <form action="code.php" method="post" enctype="multipart/form-data">
               <div class="modal-body">
               <?php
               include('../message.php');
               ?>
              
                  <?php
                   if(isset($_GET['userID']))
                      {
                         $userID = $_GET['userID'];
                         $query = "SELECT * FROM users WHERE userID='$userID' LIMIT 1";     
                         $query_run = mysqli_query($con, $query);

                         if (mysqli_num_rows($query_run) > 0) 
                          {
                            foreach ($query_run as $row) 
                            {
                              ?>
                               <div class="upload-profile-image d-flex justify-content-center pb-5">
                              <div class="text-center">
                              <!-- display profile image based on userid-->
                              <?php
                                $sql = "SELECT profileImage FROM users WHERE userID='$userID'";
                                $res = mysqli_query($con, $sql);

                              if (mysqli_num_rows($res) > 0) {
                              while ($images = mysqli_fetch_assoc($res)) { ?>
                                <div class="alb">
                                <img class="img rounded-circle" src="uploads/profile/<?=$images['profileImage']?>" style="width: 200px; height: 200px;" >
                                </div>
                              <?php } } ?>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                  <input type="hidden" name="userID" value="<?php echo $row['userID'] ?>">
                                <div class="form-group">
                                  <label for="">Name</label>
                                  <input type="text" name="fullName" value="<?php echo $row['fullName'] ?>" class="form-control" placeholder="FullName">
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Username</label>
                                  <input type="text" name="username" value="<?php echo $row['username'] ?>" class="form-control" placeholder="Username">
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Email Address</label>
                                  <input type="email"  name="email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Email">
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Phone Number</label>
                                  <input type="text" name="phoneNo" value="<?php echo $row['phoneNo'] ?>" class="form-control" placeholder="Phone No">
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">User Role</label><br>
                                  <select name="role" class="form-control" >
                                  <option value=""><?php echo $row['role'] ?></option>
                                  <option value="" disabled>choose</option>
                                  <option value="Admin">Admin</option>
                                  <option value="Landlord">Landlord</option>
                                  <option value="Tenant">Tenant</option>
                                  </select>
                                </div> 
                                </div>
                                       
                                </div>
                                <?php
                                  } 
                                }
                                else
                                {
                                    echo "<h4>No record found!</h4>";
                                }
                            } 
                            
                            ?>   
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="updateUser" class="btn btn-primary float-left">Save</button>
                              <button type="reset" class="btn btn-secondary" value="Reset">Cancel</button>
                            </div>       
               </form>

            </div>
           </div>
       </div>
    </div>
   </section>

</div>

<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>