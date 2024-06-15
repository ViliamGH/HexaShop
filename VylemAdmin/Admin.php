<?php
include "../VylemAdmin/database/img.php";
include "../VylemAdmin/database/db.php";
include "../VylemAdmin/database/authentication.php";

if (!isLogin()) {
  header("location: auth/signin.php");
  exit(0);
}

if (isset($_COOKIE['rememberEmail'])) {
  $email = $_COOKIE['rememberEmail'];
  $result = dbSelect("tbuser", "*", "Email = $email");
  $row = mysqli_fetch_array($result);
  $name = $row[3];
  $role = $row[5];
} else {
  $name = $_SESSION['username'];
  $role = $_SESSION['role'];
}


$page = "bodys/dashboard.php";
$navbars = true;
$footer = true;
if (isset($_GET['p'])) {
  $p = $_GET['p'];
  switch ($p) {
    case "card":
      $page = "bodys/card.php";
      break;
    case "insertproduct":
      $page = "bodys/insertproduct.php";
      break;
    case "signin":
      $page = "auth/signin.php";
      $navbars = false;
      $footer = false;
      break;
    case "register":
      $page = "auth/register.php";
      break;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HexashopClone Admin</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png">
  <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">
  <link rel="stylesheet" href="assets/css/styles.min.css">
  <link rel="stylesheet" href="assets/css/my.css">
  <link rel="stylesheet" href="CSS/nav.css">

  <!-- Bootstrap CSS v5.2.1 -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" /> -->
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper body-color" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include 'includes/sidebar.php'; ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php
      if ($navbars)
        include 'includes/nav.php';
      ?>
      <!--  Header End -->
      <?php include $page; ?>
      <!-- Footer Start -->
      <?php
      if ($footer)
        include 'includes/footer.php';
      ?>
      <!-- Footer End -->
    </div>
  </div>


  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>

  <!-- Fontawesome script -->
  <script src="https://kit.fontawesome.com/521359ca7b.js" crossorigin="anonymous"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> -->
</body>

</html>