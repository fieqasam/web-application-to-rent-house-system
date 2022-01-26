<?php 
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../db_connect.php');
?>
<div class="content-wrapper">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- user Modal -->
<div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <section class="content">
        <div class="container">
            <div class="row">
             <div class="col-md-12">
                <div class="card">
                  
                <!-- /.card-header -->
                <form action="code.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" name="name" class="form-control" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="">
                  </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Email Address</label>
                      <input type="email" name="email" class="form-control" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Phone Number</label>
                      <input type="text" name="phoneNo" class="form-control" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="text" name="password" class="form-control" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Confirm Password</label>
                   <input type="password" name="confirmPassword" class="form-control" placeholder="">  
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="">User Role</label>
                  <select class="form-control"  name="role"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                  <option disabled selected >choose</option>
                  <option value="Admin">Admin</option>
                  <option value="Landlord">Landlord</option>
                  <option value="Tenant">Tenant</option>
                  </select>
                </div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="submit" name="addUser" class="btn btn-primary">Save</button>
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
</div>

    <!-- Delete user -->
  <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="code.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="delete_id" class="delete_user_id">
      <p>
        Are you sure you want to delete this user?
      </p>
      </div>
      <div class="modal-footer">
        <button type="submit" name="DeleteUserbtn" class="btn btn-primary">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete user -->
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
                <h3 class="card-title text-bold font-lg" >Users
                </h3>
                  <a href="#" data-toggle="modal" data-target="#AddUserModal" class="btn btn-primary btn-sm float-right">Add New User</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr style="text-align:center;">
                          <th>#</th>
                          <th>Name</th>
                          <th>Username</th>
                          <th>Email Address</th>
                          <th>Phone Number</th>
                          <th>Role</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query = "SELECT * FROM users";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) 
                        {
                         //loop every iteration until last element
                         //for displaying all data once new data insert
                         foreach($query_run as $row)
                         {
                           //displaying all data in db
                           ?>
                         <tr style="text-align:center;">
                          <td><?php echo $row['userID']; ?></td>
                          <td><?php echo $row['fullName']; ?></td>
                          <td><?php echo $row['username']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['phoneNo']; ?></td>
                          <td><?php echo $row['role']; ?></td>
                          <td>
                            <a href="registeredUser-edit.php?userID=<?php echo $row['userID']; ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                            <button type="button" value="<?php echo $row['userID']; ?>" class="btn btn-danger btn-sm deletebtn"><i class="nav-icon fas fa-trash-alt"></i></button>
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