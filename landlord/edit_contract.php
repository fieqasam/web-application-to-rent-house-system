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
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit - Registered Users</li>
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
                    <div class="card-header">
                        <h3 class="card-title text-bold font-lg" >Edit Tenant Contract</h3>
                        <a href="landlord.php" class="btn btn-danger btn-sm float-right">Back</a>
                    </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        <form action="code.php" method="POST">
                            <div class="modal-body">
                            <?php
                            if(isset($_GET['contractID']))
                            {
                                $contractID = $_GET['contractID'];
                                $query = "SELECT * FROM contract WHERE contractID='$contractID' LIMIT 1";     
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) 
                                {
                                  foreach ($query_run as $row) 
                                  {
                                      ?>
                                      <input type="hidden" name="contractID" value="<?php echo $row['contractID'] ?>">
                                      <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="fullName" value="<?php echo $row['tenantName'] ?>" class="form-control" >
                                      </div>
                                      <div class="form-group">
                                        <label for="">Monthly Payment(RM)</label>
                                        <input type="text"  name="monthlyPayment" value="<?php echo $row['monthlyPayment'] ?>" class="form-control" >
                                      </div>
                                      <div class="form-group">
                                        <label for="">Contract Duration(Month)</label>
                                        <input type="text" name="contractDuration" value="<?php echo $row['contractDuration'] ?>" class="form-control" >
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="">Status</label><br>
                                        <select name="status" class="form-control">
                                        <option value=""><?php echo $row['status'] ?></option>
                                          <option value="">choose</option>
                                          <option value="Active">Active</option>
                                          <option value="Inactive">Inactive</option>
                                        </select>
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
                                <button type="submit" name="updateContract" class="btn btn-info float-left">Update</button>
                            </div>
                        </form>
                        </div>
                    </div>

                </div>
             </div>
            </div>
        </div>
     </div>
    </section>

</div>


<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>