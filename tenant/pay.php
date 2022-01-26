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

if (isset($_GET['paymentID'])) 
{
  $payment_id = $_GET['paymentID'];
}
?>

  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");

.form-check-input:checked {
    background-color: #8f37aa;
    border-color: #8f37aa
}

.form-check-input:focus {
    border-color: #8bbafe;
    outline: 0;
    box-shadow: none
}

label.radio {
    cursor: pointer
}

label.radio input {
    position: absolute;
    top: 0;
    left: 0;
    visibility: hidden;
    pointer-events: none
}

label.radio span {
    padding: 7px 12px;
    border: 2px solid #8f37aa;
    display: inline-block;
    color: #8f37aa;
    border-radius: 3px;
    text-transform: capitalize
}

label.radio input:checked+span {
    border-color: #8f37aa;
    background-color: #8f37aa;
    color: #fff
}

.fee {
    padding: 8px;
    border: 1px solid #eee;
    border-radius: 4px;
    box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.2);
    margin-right: 8px
}

label.radio1 {
    cursor: pointer;
    width: 100%;
    margin-right: 7px
}

label.radio1 input {
    position: absolute;
    top: 0;
    left: 0;
    visibility: hidden;
    pointer-events: none
}

label.radio1 span {
    padding: 20px 12px;
    border: 2px solid #8f37aa;
    display: inline-block;
    color: #8f37aa;
    border-radius: 3px;
    text-transform: capitalize;
    width: 100%
}

label.radio1 input:checked+span {
    border-color: #8f37aa;
    background-color: #8f37aa;
    color: #fff
}

.form-control {
    border: 2px solid #ced4da
}

.form-control:focus {
    box-shadow: none;
    border-color: #8f37aa
}

.pay {
    color: #fff;
    background-color: #8f37aa;
    border-color: #8f37aa;
    border-radius: 3px;
    padding: 8px
}

.pay:hover {
    color: #fff;
    background-color: #8f37aa;
    border-color: #8f37aa;
    border-radius: 3px;
    padding: 8px
}

.cancel {
    text-decoration: none;
    color: #8f37aa
}
  </style>

<div class="content-wrapper">

<div class="content-header">
  <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Payment Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tenant.php">Home</a></li>
              <li class="breadcrumb-item active">Payment Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Payment For Rent</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <form action="code.php" method="post" enctype="multipart/form-data">
          <div class="card-body ">
            <?php 
              $query_display  = "SELECT * FROM payment INNER JOIN rental ON payment.rentalID=rental.rentalID INNER JOIN houses ON rental.houseID= houses.houseID WHERE payment.paymentID='$payment_id'";
              $query_display_run = mysqli_query($con, $query_display);
            ?>
            <?php while($row = mysqli_fetch_array($query_display_run)):;
              $dueDate = $row['dueDate'];
              $houseName = $row['houseName'];
              $now = new DateTime($dueDate);
              echo $now->format('M'). " rent for $houseName ";
            ?>

          <div class="d-flex justify-content-between align-items-center"> <span class="text-uppercase"><?php  $now->format('M')?></span> <i class="fa fa-close close" data-dismiss="modal"></i> </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="d-flex flex-column"> <Large>Full Name</Large> <span class="font-weight-bold"><?php echo $row['tenantName'] ?></span> </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column"> <Large>Contact Number</Large> <span class="font-weight-bolder"><?php echo $phoneNo ?></span> </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="d-flex flex-column"> <Large>House Name</Large> <span class="font-weight-bold"><?php echo $row['houseName'] ?></span> </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column"> <Large>Rental Fee Due Date</Large> <span class="font-weight-bolder"><?php echo $row['dueDate'] ?></span> </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                      <div class="d-flex flex-column"> <Large>Balance Due</Large> <span class="font-weight-bolder">RM <?php echo $row['rentalPaid'] ?></span> </div>
                    </div>
                    <div class="col-md-6">
                      <div class="d-flex flex-column"> <Large>Payment Status</Large> <span class="font-weight-bolder"> <?php echo $row['statusPayment'] ?></span> </div>
                    </div>
                </div>

                <div class="mt-2 text-center fee align-items-center">
                    <h3 class="mb-0 font-weight-light">RM <?php echo $row['rentalPaid'] ?></h3>
                </div>        
                <!--  section for payment method-->
                <div class="mt-3"> <Large>Payment Method</Large>
                    <div class="d-flex flex-row"> <label class="radio1"> <input type="radio" name="payment" value="bank"><span> <i class="fa fa-bank"></i>BANK TRANSFER</span> </label> <label class="radio1"> <input type="radio" name="payment" value="card"> <span><i class="fa fa-credit-card-alt"></i> CREDIT CARD</span> </label> </div>
                </div>
                <div class="mt-3 mr-2">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <div class="inputbox"> <Large>Select Your Bank</Large> 
                            <select class="form-control" id="ccmonth">
                              <option value="" selected disabled>--Please select your Bank--</option>
                              <option>Maybank2u</option>
                              <option>CIMB Clicks</option>
                              <option>Public Bank</option>
                              <option>RHB Now</option>
                              <option>Hong Leong Connect</option>
                              <option>Ambank</option>
                               <option>MyBSN</option>
                               <option>Bank Rakyat</option>
                              <option>UOB</option>
                              <option>Bank Islam</option>
                              <option value="">HSBC Online</option>
                              <option value="">Affin Bank</option>
                             </select> 
                        </div>
                      </div>
                      
                        <div class=" mt-3 col-md-10">
                            <div class="inputbox"> <Large>Total (RM) </Large> 
                            <input type="text" class="form-control" name="amountPay" value="<?php echo $row['rentalPaid'] ?>"> </div>
                            <input type="hidden" class="form-control" name="paymentID" value="<?php echo $payment_id; ?>">
                            <input type="hidden" class="form-control" name="tenantName" value="<?php echo $row['tenantName']; ?>">
                            <div class="input-group"> <input type="hidden" placeholder="" name="recipient" class="form-control" value="<?php echo $row['tenantEmail'] ?>" required> </div>
                        </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <hr class="mr-2 mt-4">
                <div class="mt-3 mr-2 d-flex justify-content-end align-items-center"> 
                  <button type="submit" name="submitPayment" class="btn btn-primary btn-block">Submit Payment</button> 
                </div>
          </div>
        </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php include('includes/script.php');?>
<?php include('includes/footer.php');?>