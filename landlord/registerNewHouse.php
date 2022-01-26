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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="stylesheet">

  <style>
    
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  body {
    font-family:"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    font-size: 1rem;
    color: #2c2c2c;
  }
  body a {
    color: inherit;
    text-decoration: none;
  }
  .header {
    max-width: 600px;
    margin: 50px auto;
    text-align: center;
  }
  
  .header__title {
    margin-bottom: 30px;
    font-size: 2.1rem;
  }
  
  .content {
    width: 95%;
    margin: 0 auto 50px;
  }
  
  .content__title {
    margin-bottom: 40px;
    font-size: 20px;
    text-align: center;
  }
  
  .content__title--m-sm {
    margin-bottom: 10px;
  }
  
  .multisteps-form__progress {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(0, 1fr));
  }
  
  .multisteps-form__progress-btn {
    transition-property: all;
    transition-duration: 0.15s;
    transition-timing-function: linear;
    transition-delay: 0s;
    position: relative;
    padding-top: 20px;
    color: rgba(108, 117, 125, 0.7);
    text-indent: -9999px;
    border: none;
    background-color: transparent;
    outline: none !important;
    cursor: pointer;
  }
  @media (min-width: 500px) {
    .multisteps-form__progress-btn {
      text-indent: 0;
    }
  }
  .multisteps-form__progress-btn:before {
    position: absolute;
    top: 0;
    left: 50%;
    display: block;
    width: 13px;
    height: 13px;
    content: '';
    -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
    transition: all 0.15s linear 0s, -webkit-transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
    transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
    transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s, -webkit-transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
    border: 2px solid currentColor;
    border-radius: 50%;
    background-color: #fff;
    box-sizing: border-box;
    z-index: 3;
  }
  .multisteps-form__progress-btn:after {
    position: absolute;
    top: 5px;
    left: calc(-50% - 13px / 2);
    transition-property: all;
    transition-duration: 0.15s;
    transition-timing-function: linear;
    transition-delay: 0s;
    display: block;
    width: 100%;
    height: 2px;
    content: '';
    background-color: currentColor;
    z-index: 1;
  }
  .multisteps-form__progress-btn:first-child:after {
    display: none;
  }
  .multisteps-form__progress-btn.js-active {
    color: #007bff;
  }
  .multisteps-form__progress-btn.js-active:before {
    -webkit-transform: translateX(-50%) scale(1.2);
            transform: translateX(-50%) scale(1.2);
    background-color: currentColor;
  }
  
  .multisteps-form__form {
    position: relative;
  }
  
  .multisteps-form__panel {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 0;
    opacity: 0;
    visibility: hidden;
  }
  .multisteps-form__panel.js-active {
    height: auto;
    opacity: 1;
    visibility: visible;
  }
  .multisteps-form__panel[data-animation="scaleOut"] {
    -webkit-transform: scale(1.1);
            transform: scale(1.1);
  }
  .multisteps-form__panel[data-animation="scaleOut"].js-active {
    transition-property: all;
    transition-duration: 0.2s;
    transition-timing-function: linear;
    transition-delay: 0s;
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  .multisteps-form__panel[data-animation="slideHorz"] {
    left: 50px;
  }
  .multisteps-form__panel[data-animation="slideHorz"].js-active {
    transition-property: all;
    transition-duration: 0.25s;
    transition-timing-function: cubic-bezier(0.2, 1.13, 0.38, 1.43);
    transition-delay: 0s;
    left: 0;
  }
  .multisteps-form__panel[data-animation="slideVert"] {
    top: 30px;
  }
  .multisteps-form__panel[data-animation="slideVert"].js-active {
    transition-property: all;
    transition-duration: 0.2s;
    transition-timing-function: linear;
    transition-delay: 0s;
    top: 0;
  }
  .multisteps-form__panel[data-animation="fadeIn"].js-active {
    transition-property: all;
    transition-duration: 0.3s;
    transition-timing-function: linear;
    transition-delay: 0s;
  }
  .multisteps-form__panel[data-animation="scaleIn"] {
    -webkit-transform: scale(0.9);
            transform: scale(0.9);
  }
  .multisteps-form__panel[data-animation="scaleIn"].js-active {
    transition-property: all;
    transition-duration: 0.2s;
    transition-timing-function: linear;
    transition-delay: 0s;
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  </style>
</head>

<body>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Register House</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="landlord.php">Home</a></li>
              <li class="breadcrumb-item active">Register Rent House</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div  class="container overflow-hidden">
            <div class="multisteps-form">
            <div class="multisteps-form__progress">
            <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">House Information</button>
            <button class="multisteps-form__progress-btn" type="button" title="Address">Description</button>
            <button class="multisteps-form__progress-btn" type="button" title="Order Info">Rental Information</button>
            <button class="multisteps-form__progress-btn" type="button" title="Message">Contract Information </button>
            </div>
            </div>
          </div>
        <div class="card-body">
        <div class="row">
            <div class="col-12 m-auto">
              <form class="multisteps-form__form" action="code.php" method="post" enctype="multipart/form-data">
              <?php
              include('../message.php');
              ?>
                <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                  <h3 class="multisteps-form__title">House Information</h3>
                  <div class="multisteps-form__content">
                  <div class="form-row mt-4">
                  <div class="col-md-6">
                  <div class="form-group">
                  <label for="">House Name</label>
                  <input type="text" name="houseName" class="form-control" placeholder="" required>
                </div>
                  </div>
                  <div class="col-md-6">
                <div class="form-group">
                    <?php 
                      $query_category="SELECT * FROM housecategory";
                      $query_category_run = mysqli_query($con, $query_category);
                    ?>
                    <label for="">Type</label>
                    <select class="form-control"  name="category" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" required>
                      <option selected disabled>choose</option>
                      <?php while($row1 = mysqli_fetch_array($query_category_run)):;?>
                      <option value="<?php echo $row1['categoryName'];?>"><?php echo $row1['categoryName'];?></option>
                      <?php endwhile; ?> 
                    </select>
                 </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Address 1</label>
                    <input type="text" name="address1" class="form-control" placeholder="address 1" required>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                  <label for=""> Address 2</label>
                  <input type="text" name="address2" class="form-control" placeholder="address 2" required>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                  <label for="">Postcode</label>
                  <input type="number" name="postcode" class="form-control" placeholder="" required>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                  <label for="">District</label>
                  <input type="text" name="district" class="form-control" placeholder="" required>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                  <label for="">State</label>
                  <select class="form-control"  name="state" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" required>
                      <option selected disabled>choose</option>
                      <option value="Johor">Johor</option>
                      <option value="Kedah">Kedah</option>
                      <option value="Perak">Perak</option>
                      <option value="Kelantan">Kelantan</option>
                      <option value="Negeri Sembilan">Negeri Sembilan</option>
                      <option value="Melaka">Melaka</option>
                      <option value="Pulau Pinang">Pulau Pinang</option>
                      <option value="Pahang">Pahang</option>
                      <option value="Perlis">Perlis</option>
                      <option value="Sabah">Sabah</option>
                      <option value="Sarawak">Sarawak</option>
                      <option value="Selangor">Selangor</option>
                      <option value="Terangganu">Terangganu</option>
                      <option value="Kuala Lumpur">Kuala Lumpur</option>
                    </select>
                  </div>
                  </div>
                  </div>  
                  <div class="button-row d-flex mt-4">
                    <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                  </div>
                  </div>
                </div>
              <!--Description -->
                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                  <h3 class="multisteps-form__title">Description</h3>
                  <div class="multisteps-form__content">
                    <div class="form-row mt-4">
                    <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Size (sq.ft)</label>
                      <input type="number" name="size" class="form-control" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">No of room</label>
                      <input type="number" name="noRoom" class="form-control" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">No of bathroom/toilet</label>
                      <input type="number" name="noToilet" class="form-control" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Type of floor</label>
                      <input type="text" name="floorType" class="form-control" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Availability of living room</label>
                      <input type="text" name="livingRoom" class="form-control" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Availability of air-conditioner</label>
                      <input type="number" name="airCond" class="form-control" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Availability of kitchen</label>
                      <input type="text" name="kitchen" class="form-control" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Type of kitchen</label>
                      <input type="text" name="typeKitchen" class="form-control" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Wifi-availability</label>
                      <input type="text" name="wifi" class="form-control" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Furniture</label>
                      <select class="form-control" name="furniture" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" required>
                      <option selected disabled>choose</option>
                      <option value="Full">Full</option>
                      <option value="Half">Half</option>
                      <option value="Not-Supported">Not-Supported</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Gate</label>
                      <select class="form-control" name="gate" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" required>
                      <option selected disabled>choose</option>
                      <option value="Auto">Auto</option>
                      <option value="Manual">Manual</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">CCTV</label>
                      <select class="form-control" name="cctv" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" required>
                      <option selected disabled>choose</option>
                      <option value="Available">Available</option>Full
                      <option value="Not-available">Not-available</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Gate and Guarded</label>
                      <select class="form-control" name="gateNguarded" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" required>
                      <option selected disabled>choose</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                  <label for="">Full-Fronted Picture</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" name="house_image1" required> 
                    </div>
                    </div>
                  </div>
                    </div>
                <div class="col-md-12">
                  <div class="form-group">
                  <label for="">Others Picture(bathroom,bedroom,kitchen,living room,etc)</label>
                  </div>
                </div>
                <div class="form-row">
                <div class="col-md-4">
                    <div class="form-group">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" name="house_image2" required> 
                    </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" name="house_image3" required> 
                    </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" name="house_image4" required> 
                    </div>
                  </div>
                  </div>
                  </div>
                    <div class="button-row d-flex mt-4">
                      <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                      <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                    </div>
                  </div>
                </div>
              <!--Rental Information -->
                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                  <h3 class="multisteps-form__title">Rental Information</h3>
                  <div class="multisteps-form__content">
                    <div class="row">
                    <div class="col-md-6">
                  <label for="">Rate per month</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">RM</span>
                      <input type="decimal" class="form-control" name="monthlyPaid" required> 
                    </div>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <label for="">Negotiable</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                    <select class="form-control" name="negotiable" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                      <option selected disabled>choose</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-6">
                    <label for="">Deposit</label>
                    <div class="form-group">
                      <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">RM</span>
                      <input type="decimal" class="form-control" name="deposit" required> 
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="">Description</label>
                    <div class="form-group">
                      <input type="text" class="form-control" name="description" required>
                    </div>
                  </div>
                  </div>
                    <div class="row">
                      <div class="button-row d-flex mt-4 col-12">
                        <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                        <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                      </div>
                    </div>
                  </div>
                </div>
              <!-- Contract Information-->
                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                  <h3 class="multisteps-form__title">Contract Information</h3>
                  <div class="multisteps-form__content">
                  <div class="form-row mt-4">
                    <div class="col-md-6">
                     <label for="">Contract</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" name="file" required> 
                    </div>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <label for="">Subject to change</label>
                    <div class="form-group">
                    <div class="input-group mb-3">
                    <select class="form-control" name="changeSubject" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                      <option selected disabled>choose</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                    </div>
                  </div>
                  </div>
                </div>
                  <input type="hidden" name="houseStatus" value="available">
                  <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                <div class="button-row d-flex mt-4">
                  <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                  <button class="btn btn-success ml-auto" type="submit"  name="saveHouse">Send</button>
                </div>
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</section>
<script  src="function.js"></script>
</div>
</body>
</html>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?> 