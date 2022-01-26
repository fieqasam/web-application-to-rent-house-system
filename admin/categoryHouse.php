<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../db_connect.php');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENT HOUSE</title>
    <style>
	
	td{
		vertical-align: middle !important;
	}
</style>
</head>
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
<!-- content header -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">House Type</h1>
          <p style="color:grey;">you may add new house type if not listed in the list.</p>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
              <li class="breadcrumb-item active">House Type
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- Modal -->
  <!-- Update house -->
<div class="modal fade" id="EditCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Update House Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="code.php" method="POST">
        <div class="modal-body">
        <input type="hidden" name="update_id" class="update_category_id">
        <label class="control-label">Name</label>
				<input type="text" class="form-control" name="categoryName">
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="updateCategoryBtn">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Update house -->

<!-- Delete house -->

<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete House Type</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="code.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="delete_id" class="delete_category_id">
      <p>
        Are you sure you want to delete this data?
      </p>
      </div>
      <div class="modal-footer">
        <button type="submit" name="DeleteCategorybtn" class="btn btn-primary">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete user -->


<div class="container-fluid">
    <?php
    include('../message.php');
    ?>
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="code.php" method="post" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header">
						  <h5  class=" text-bold font-lg">Add New House Type</h5>  
				  	</div>
					<div class="card-body">
							<input type="hidden" name="userID" value="<?php echo $userID; ?>">
							<div class="form-group">
								<label class="control-label">Name</label>
								<input type="text" class="form-control" name="categoryName">
							</div>
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="addCategoryBtn"> Submit</button>
								<button class="btn btn-sm btn-default col-sm-3" type="reset" > Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
	<section class="content" >
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
                <h5 class="text-bold font-lg" >Listing House Type
                </h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr style="text-align:center;">
                          <th>House Type</th>
                          <th>Update</th>
                          <th>Delete</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query="SELECT * FROM housecategory";  
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
                          <td width="10%"><?php echo $row['categoryName']; ?></td>
                          <td>
                          <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-info btn-sm updatebtn"><i class="fas fa-edit"></i></button>
                          </td>
                          <td>
                          <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn"><i class="nav-icon fas fa-trash-alt"></i></button>
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
			<!-- Table Panel -->
		</div>
	</div>	

</div>


</div>

</div>
<?php include('includes/script.php');?>

<!--script to update category name -->
<script>
  $(document).ready(function(){
    $('.updatebtn').click(function (e) {
        e.preventDefault();
        var id = $(this).val();
        //console.log(userID);
        $('.update_category_id').val(id);
        $('#EditCategoryModal').modal('show');

    });
  });
</script>
<!--script to delete category house -->
<script>
  $(document).ready(function(){
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        var id = $(this).val();
        //console.log(userID);
        $('.delete_category_id').val(id);
        $('#DeleteModal').modal('show');

    });
  });
</script>
<?php include('includes/footer.php');?>
