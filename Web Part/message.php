<?php
if(isset($_SESSION['msg'])) :
?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><?php echo $_SESSION['name'];?>!</strong> <?php echo $_SESSION['msg'];?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php 
    unset($_SESSION['msg']);
    endif;
?>