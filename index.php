<?php
require_once 'helper.php';
?>

<?php
include_once 'header.php';
?>

<div class="text-center">
  <!-- INSERT IMAGE  -->
  <img src="<?=BASE_URL?>/assets/images/logo.png" width="100" alt="">
  <h3>
    <?=SITE_NAME?>
  </h3>

  <div>
    <?php
      if(isLoged()) {
        echo '<h3>Welcome '.$_SESSION['user_fullname'].'</h3>';
        echo '<a href="'.BASE_URL.'/profile.php">profile</a> | ';
        echo '<a href="'.BASE_URL.'/logout.php">Logout</a>';
      }else{
        echo '<a href="'.BASE_URL.'/sign-in.php">Sign In</a> |';
        echo '<a href="'.BASE_URL.'/sign-up.php">Sign Up</a>';
      }
    ?>
  </div>
</div>

<?php
include_once 'footer.php';
?>
