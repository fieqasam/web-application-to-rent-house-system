<?php
session_start();
include'header.php';
 if ($_SESSION['auth'] == "Landlord") {
     header("Location:landlord/landlord.php");
     exit(0);
 }else if ($_SESSION['auth'] == "Tenant") {
    header("Location:tenant/tenant.php");
    exit(0);
 }
?>
<!-- banner -->
<div class="inside-banner">
  <div class="container"> 
    <span class="pull-right"><a href="#">Home</a> /Login</span>
    <h2>Login</h2>
</div>
</div>
<!-- banner -->
<div class="container">
<div class="spacer">
<div class="row register">
<?php 
    include('message.php');
?>
    <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">

    <form action="signIn_process.php" method="POST">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="you@gmail.com">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="*******">
                            </div>
                           
                            <hr>
                            <div class="form-group" >
                                <button type="submit" name="loginBtn" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <div style="text-align:center">
                            <a  href="signUp.php" >Don't have any account yet? register now</a>
                            </div>
                        </form>

    </div>
</div>
</div>
</div>

<?php include'footer.php';?>