<?php
if (isset($_SESSION['status']))
{
   ?>
   <div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <strong><?php echo $_SESSION['status']; ?></strong> 
    <button type="button" class="btn-close" data-dismiss="alert" >
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
   <?php
   unset($_SESSION['status']);
}
?>
