<?php 
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../db_connect.php');

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
          <h1 class="m-0 text-dark">Move-In Move-Out Responses</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboardLandlord.php">Home</a></li>
              <li class="breadcrumb-item active">Move-In Move-Out Responses</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
 <!-- Delete user -->
 <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Form</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="delete_id" class="delete_response_id">
      <p>
        Are you sure you want to delete this form?
      </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="DeleteFormbtn" class="btn btn-primary">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete user -->
 <!-- Main content -->
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
                 <table id="example1" class="table table-bordered table-striped">
                     <thead>
                     <tr style="text-align:center">
                      <th style="width: 10px">#</th>
                      <th>Tenant Name</th>
                      <th>Checklist Form</th>
                      <th>Message</th>
                      <th>Status</th>
                      <th>Date Submit</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                     </thead>
                     <tbody>
                     <?php 
                     $sr_no = 1;
                     $query_response = mysqli_query($con, "SELECT * FROM reponses WHERE landlordID='$userID'");
                     while ($main_result = mysqli_fetch_assoc($query_response)) :?>
                      <tr style="text-align:center">
                      <td><?php echo $sr_no++; ?></td>
                      <td><?php echo $main_result['tenantName'] ?></td>
                      <td><a href="checklistResponse.php?responseFile=<?php echo $main_result['responseFile'] ?>"><?php echo $main_result['responseFile'] ?></a> </td>
                      <td><?php echo $main_result['message'] ?></td>
                      <td>
                        <?php 
                        if ($main_result['status'] == 'pending') 
                        {
                          ?> <h5><span class="badge bg-warning"><?php echo $main_result['status'] ?></span></h5>
                       
                          <?php
                        }
                        else {
                          ?><h5> <span class="badge bg-success"><?php echo $main_result['status'] ?></span> </h5><?php
                        }
                        ?>
                      </td>
                      <td><?php echo $main_result['dateSent'] ?></td>
                      <td width=15%;>  
                      <a href="checklistForm-Details.php?respID=<?php echo $main_result['respID']; ?>" class="btn btn-info btn-md"><i class="fas fa-edit"></i></a>
                      <button type="submit" name="delete_house" class="btn btn-danger deletebtn" value="<?php echo $main_result['respID']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
                    </td>
                    </tr>
                    <?php endwhile ?>
                  </tbody>
                 </table>    
             </div>
         </div>
       </div>
     </div>
   </div>
   </section>

</div>
<?php include('includes/script.php');?>
  <!--script to delete message -->
  <script>
  $(document).ready(function(){
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        var respID = $(this).val();
        //console.log(userID);
        $('.delete_response_id').val(respID);
        $('#DeleteModal').modal('show');

    });
  });
</script>
<?php include('includes/footer.php');?>
