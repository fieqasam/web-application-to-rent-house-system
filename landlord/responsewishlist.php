<?php
session_start();
include('includes/header.php');
include('includes/sidebar.php');
include('includes/topbar.php');
include('../db_connect.php');
if (isset($_GET['id'])) 
{
  $main_id = $_GET['id'];
  $sql_update = mysqli_query($con, "UPDATE notifications SET status=1 WHERE id='$main_id'");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>RENT HOUSE</title>
 
</head>
<body>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Response Wishlist</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
              <li class="breadcrumb-item active">Response Wishlist
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
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>sr_no</th>
                <th>Sender Name</th>
                <th>Sender Email</th>
                <th>Sender Phone No</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sr_no = 1;
              $sql_get = mysqli_query($con, "SELECT * FROM notifications WHERE status=1 AND landlordID='$userID' AND id='$main_id'");
              while ($main_result = mysqli_fetch_assoc($sql_get)) :?>
              <tr>
                <th><?php echo $sr_no++; ?></th>
                <td><?php echo $main_result['senderName']; ?></td>
                <td><?php echo $main_result['senderEmail']; ?></td>
                <td><?php echo $main_result['senderNumber']; ?></td>
                <td><?php echo $main_result['message']; ?></td>
                <td><?php echo $main_result['date']; ?></td>
                <td>
                <script type="text/javascript">
                    function Form() {
                        var selectvalue= $('input[name=link]:checked','#Form').val();
                        if (selectvalue=="accept") {
                            window.open('wishlistdetail.php?id=<?php echo $main_result['id']; ?>','_self');
                            return true;
                        }
                       else if (selectvalue=="reject") {
                            window.open('rejectTenant.php?id=<?php echo $main_result['id'] ?>','_self');
                            return true;
                        }
                        return false;
                    };
                </script>
                  <form id="Form">
                    <input type="radio" onClick="Form()" name="link" value="accept"/> Accept &nbsp;
                    <input type="radio" onClick="Form()" name="link" value="reject"/> Reject
                  </form>
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
</body>
</html>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?> 