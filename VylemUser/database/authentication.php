<?php
session_start();
function isLogin()
{
  if (isset($_COOKIE['rememberEmail'])) {
    return true;
  } elseif (isset($_SESSION['valid']) && $_SESSION['valid'] == true) {
    return true;
  } else {
    return false;
  }
}
function validUser($email, $password)
{
  $result = dbSelect("tbuser", "*", "Email = '$email' and Password = md5 ('" . $password . "') and Active = '1'", "");
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    $row = mysqli_fetch_array($result);
    $_SESSION['valid'] = true;
    $_SESSION['username'] = $row[3];
    $_SESSION['role'] = $row[5];

    date_default_timezone_set("Asia/Bangkok");
    $today = date('Y-m-d h:i:s');
    dbUpdate("tbuser", ["Lastlogin" => "$today"], "Username ='$row[3]'");
    return true;
  } else {
    return false;
  }
}
function Logout()
{
  setcookie("rememberEmail", "", time() - 36000);
  setcookie("remember", "", time() - 3600);
  session_destroy();
}


/* for sign in in userpage to catach which role is admi or user. (not success yet).

<?php
include "../VylemUser/database/db.php";
include "../VylemUser/database/authentication.php";

$error = 0;
$remember = "";
if (isset($_POST['txtEmail'])) {
  $email = strtolower(trim($_POST['txtEmail']));
  $password = $_POST['txtPassword'];

  if (isset($_POST['txtCheck'])) {
    $remember = $_POST['txtCheck'];
  }
  $valid = validUser($email, $password);
  if ($valid) {
    if (isset($_POST['txtCheck'])) {
      $remember = $_POST['txtCheck'];
      setcookie("rememberEmail", $email, time() + 3600 * 24 * 365);
      setcookie("remember", $remember, time() + 3600 * 24 * 365);
    } else {
      setcookie("rememberEmail", "", time() - 36000);
      setcookie("remember", "", time() - 3600);
    }
    header("location: ../Web.php");
    exit(0);
  } else {
    $error = 1;
  }
}

?>

*/