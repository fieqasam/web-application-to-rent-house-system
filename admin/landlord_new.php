<?php
  session_start();
  include('includes/header.php');
  include('includes/topbar.php');
  include('includes/sidebar.php');
  include('../db_connect.php');
?>
<html>
<head>

</head>
<style>
    table{
        width: 100%;
    }
</style>
<body>
    

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

 <!-- add new Tenant section -->
  <!-- Tenant Modal -->
  <div class="modal fade" id="AddTenantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Tenant</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- /.content-header -->
    <section class="content">
        <div class="container">
        <?php 
          $query="SELECT * FROM house";
          $query_run = mysqli_query($con, $query);
        ?>
            <div class="row">
             <div class="col-md-12">
                <div class="card">
                  
                <!-- /.card-header -->
                <form action="code.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="row">
          
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="fullName" class="form-control" placeholder="">
                  </div>
                  </div>
                  
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="">
                  </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Identification No/IC</label>
                      <input type="text" name="identificationNo" class="form-control" placeholder="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Mobile Number</label>
                      <input type="tel" name="phoneNo" class="form-control" placeholder="">
                    </div>
                  </div>
                  </div>

                  <div class="form-group">
                    <label for="">Current Address</label>
                    <textarea  class="form-control" name="address" aria-label="With textarea">
                    </textarea>     
                  </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" name="addTenant" class="btn btn-primary">Save</button>
                </div>

                </form>
                
             </div>
            </div>
        </div>
     </div>
    </section>

    </div>
  </div>
  </div>
 <!-- End Tenant modal -->

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
      <input type="hidden" name="delete_id" class="delete_tenant_id">
      <p>
        Are you sure you want to delete this data?
      </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="submit" name="DeleteTenantbtn" class="btn btn-primary">DELETE</button>
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
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" >Registered Tenant</li>
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
              <div class="card-header">
                <h3 class="card-title text-bold font-lg" >REGISTERED LANDLORD
                </h3>
                  <a href="#" data-toggle="modal" data-target="#AddLandlordModal" class="btn btn-primary btn-sm float-right">ADD NEW LANDLORD</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" width="100%" >
                  <table id="example1" class="table table-bordered table-striped" width="100%">
                      <thead>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Username</th>
                          <th>Identification No/IC</th>
                          <th>Email</th>
                          <th>Mobile Phone(No)</th>
                          <th>Property ID</th>
                          <th>Address</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query = "SELECT * FROM landlord";
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
                          <td><?php echo $row['landlordID']; ?></td>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['username']; ?></td>
                          <td><?php echo $row['identityNo']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['contactNo']; ?></td>
                          <td><?php echo $row['propertyID']; ?></td>
                          <td style="text-align: justify;"><?php echo $row['address']; ?></td>
                          <td width="15%">
                            <a href="landlordEdit.php?landlordID=<?php echo $row['landlordID']; ?>" class="btn btn-info btn-sm">EDIT</a>
                            <button type="button" value="<?php echo $row['landlordID']; ?>" class="btn btn-danger btn-sm deletebtn">DELETE</button>
                          </td>
                         
                      </tr>
                           <?php
                         }
                        }
                        else
                        {
                          ?>
                          <tr>
                            <td>No record found in the database.</td>
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
    </section>


</div>

</div>
<?php include('includes/script.php');?>
  <!--script to delete user -->
<script>
  $(document).ready(function(){
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        var userID = $(this).val();
        //console.log(userID);
        $('.delete_tenant_id').val(userID);
        $('#DeleteModal').modal('show');

    });
  });
</script>

<?php include('includes/footer.php');?>
</body>
</html>