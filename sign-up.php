<?php
require_once 'config/db.php';
$ms = '';
// check button sign up is cliked
if(isset($_POST['signup'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $fullname = $_POST['fullname'];

  // check email
  $sql = "SELECT * FROM users WHERE email = ?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $stmt->store_result();
  if($stmt->num_rows==0) {
    
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO users (email, password, fullname) VALUES (?, ?, ?)';
    $stmt = $db->prepare($sql);
    $stmt->bind_param('sss', $email, $password, $fullname);
    $stmt->execute();
    $ms = '<div class="alert alert-success">Sign up Susscess plases go to Sign in</div>';
  }else{
    $ms = '<div class="alert alert-danger">Email already exists</div>';
  }

  
}

include_once 'header.php';
?>

  <div class="form-sign-in">
    <div class="text-center">
      <h4>
        Sign Up
      </h4>
    </div>

    <form action="" method="post">
      <label for="fullname">Fullname</label>
      <input type="text" name="fullname" id="fullname"  class="w-100 mb-1"  required>

      <label for="email">Email</label>
      <input type="text" name="email" id="email"  class="w-100 mb-1"  required>

      <label for="password">Password</label>
      <input type="password" name="password"  class="w-100 mb-1"  required> <br>
      <?php
      // dsi massage after sign up
      echo $ms;
      ?>
      <input type="submit" value="Sign Up" name="signup">
      <a href="<?BASE_URL?>/sign-in.php">Sign In</a>
    </form>

  </div>

  <div class="text-center w-auto">
      <hr class="w-100">
      <a href="<?BASE_URL?>">Go Home</a>
  </div>

<?php
include_once 'footer.php';
?>