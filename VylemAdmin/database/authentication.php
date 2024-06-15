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
    // $result = dbSelect("tbuser", "*", "Email='$email' and Password=md5 ('" . $password . "') and Active = '1'", "");
    $result = dbSelect("tbuser", "*", "Email='$email' and Password=md5 ('" . $password . "') and Active = '1'", "");
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
    }
    return false;
}
function Logout()
{
    setcookie("rememberEmail", "", time() - 36000);
    setcookie("remember", "", time() - 3600);
    session_destroy();
}
