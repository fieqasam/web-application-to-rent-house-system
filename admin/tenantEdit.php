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
            <h1 class="m-0 text-dark">Tenant</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
              <li class="breadcrumb-item active">Update Tenant </li>
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
                        <h3 class="card-title text-bold font-lg" >Update Tenant
                        </h3>
                        <a href="tenant.php" class="btn btn-danger btn-sm float-right">Back</a>
                    </div>
                <!-- /.card-header -->
                <form action="code.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                <?php
                include('../message.php');
                ?>
                <?php 
                if (isset($_GET['tenantID']))
                {
                  $tenantID = $_GET['tenantID'];
                  $query = "SELECT * FROM tenant WHERE tenantID='$tenantID' LIMIT 1";
                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) 
                  {
                    foreach($query_run as $row)
                    {
                      ?>
                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="hidden" name="tenantID" placeholder="ID" value="<?php echo $tenantID;?>">
                            <label for="">Name</label>
                            <input type="text" name="fullName" value="<?php echo $row['fullName'] ?>" class="form-control" placeholder="">
                          </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Email Address</label>
                          <input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="">
                        </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Identity No/IC</label>
                            <input type="text" name="identificationNo" value="<?php echo $row['identificationNo'] ?>" class="form-control" placeholder="">
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Contact No</label>
                            <input type="text" name="phoneNo" value="<?php echo $row['phoneNo'] ?>" class="form-control" placeholder="">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                          <label for="">Address</label>
                          <textarea class="form-control" name="address" aria-label="With textarea"><?php echo $row['address'] ?>
                          </textarea>     
                        </div>

                      <div class="modal-footer">
                        <button type="submit" name="update_tenant" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-secondary" value="Reset">Cancel</button>
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
                
                </form>

             </div>
            </div>
        </div>
     </div>
    </section>

</div>
<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>