<?php
require_once 'helper.php';
require_once 'config/db.php';
if (!isLoged()) {
    header('location: sign-in.php');
    exit();
}
?>
<?php
// update profile when update clicked
if (isset($_POST['update'])) {
    $fullname = trim($_POST['fullname']);
    if ($fullname) {
        $update = 'update users set fullname = ? where id = ?';
        $stmt = $db->prepare($update);
        $stmt->bind_param('si', $fullname, $_SESSION['user_id']);
        $stmt->execute();
    }

}

// get data prfile
$sql = "SELECT * FROM users WHERE id = ? ";
$stmt = $db->prepare($sql);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_object();

?>

<?php
include_once 'header.php';
?>

<div class="text-center">
  <h3>Profile</h3>
  <div>
    Name:
    <form action="" method="post">
      <input type="text" name="fullname" value="<?php echo $row->fullname ?>" required min-lenght="4">
      <input type="submit" name="update" value="Update">
    </form>
  </div>
  <div>
    Email : <?=$_SESSION['user_email']?>
  </div>
  <div>
    <a href="<?=BASE_URL?>/logout.php">Logout</a>
  </div>
</div>


<div class="text-center w-auto">
      <hr class="w-100">
      <a href="<?BASE_URL?>/index.php">Go Home</a>
  </div>
<?php
include_once 'footer.php';
?>