<?php
session_start();
include('header.php');
?>
<!-- banner -->
<div class="inside-banner">
  <div class="container"> 
    <span class="pull-right"><a href="#">Home</a> / Register</span>
    <h2>Register</h2>
</div>
</div>
<!-- banner -->
<div class="container">
<div class="spacer">
<div class="row register">
  <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
  <form action="signUp_process.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
         <label for="">Full name</label>
         <input type="text" name="fullName" class="form-control" placeholder="Johny Deep" required>
    </div>
    <div class="form-group">
        <label for="">Username</label>
        <input type="text" name="username" class="form-control" placeholder="John" required>
    </div>
    <div class="form-group">
         <label for="">Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="you@gmail.com" required>
    </div>
    <div class="form-group">
        <label for="">Phone Number</label>
        <input type="text" name="phoneNo" class="form-control" placeholder="0123456790" required>
    </div>
    <div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <label for="">Password</label>
        <input type="password" name="password" class="form-control" placeholder="********" required>
         </div>
    </div>
    <div class="col-md-6">
         <div class="form-group">
        <label for="">Confirm Password</label>
        <input type="password" name="confirmPass" class="form-control" placeholder="********" required>
        </div>
    </div> 
    </div>
    <div class="row">
        <div class="col-md-6">
        <label for="inputUser">User Role</label>
        <select name="role" class="form-control">
        <option selected disabled>Choose</option>
        <option value="Landlord">Landlord</option>
        <option value="Tenant">Tenant</option>
        </select>
        </div>
        <div class="col-md-6">
        <label for="inputUser">Profile Picture</label>
        <?php if (isset($_GET['error'])): ?>
        <p><?php echo $_GET['error']; ?></p>
        <?php endif ?>
        <input type="file" name="my_image" required>   
        </div>
    </div>
    <button type="submit" name="registerBtn" class="btn btn-primary btn-lg btn-block">Register</button>
        <div style="text-align:center">
        <a  href="signIn.php" >Already have an account ?Login now</a>
        </div>
  </form>
  </div> 
</div>
</div>
</div>
<?php include'footer.php';?>
