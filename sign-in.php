<?php
session_start();
?>
<?php
require_once 'config/db.php';
$ms = '';
// check login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // check email
    $sql = "SELECT * FROM users WHERE email = ? ";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if ($result->num_rows > 0) {
      $row = $result->fetch_object();
        
        if (password_verify($password, $row->password)) {
            
            $_SESSION['user_id'] = $row->id;
            $_SESSION['user_email'] = $row->email;
            $_SESSION['user_fullname'] = $row->fullname;
            // set user role
            $_SESSION['user_role'] = $row->role;
            header('location: index.php');
            exit();
        } else {
            $ms = '<div class="alert alert-danger">Sing in Fail</div>';
        }
    } else {
        $ms = '<div class="alert alert-danger">Sing in Fail</div>';
    }
}
?>
<?php
include_once 'header.php';
?>

  <div class="form-sign-in">


    <div class="text-center">

      <h4>
        Sign In
      </h4>
    </div>

    <form action="" method="post">

      <label for="email">Email</label>
      <input type="text" name="email" id="email" class="w-100 mb-1" required>

      <label for="password">Password</label>
      <input type="password" name="password"  class="w-100 mb-1"  required> <br>
      <?php
      // display message after login
      echo $ms;
      ?>
      <input type="submit" name="login" value="Sign In">
      <a href="<?BASE_URL?>/sign-up.php">Sign Up</a>
    </form>
  </div>

  <div class="text-center w-auto">
      <hr class="w-100">
      <a href="<?BASE_URL?>">Go Home</a>
  </div>

<?php
include_once 'footer.php';
?>