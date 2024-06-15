<?php
include "../../VylemAdmin/database/db.php";
include "../../VylemAdmin/database/authentication.php";

$error = 0;
$remember = "";

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  Logout();
}

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
    header("location: ../Admin.php");
    exit(0);
  } else {
    $error = 1;
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <title>HexaShopClone</title>
  <meta charset="utf-8" />
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">

</head>

<body>

  <section class="container d-flex justify-content-center align-items-center border-dark border border-3 w-75" style="margin-top: 150px;">
    <div class="row">
      <div class="col-12">
        <form action="signin.php" method="POST" class="m-auto mt-5" novalidate>
          <div class="text-center mb-4">
            <a href="signin.php" class="py-4 block"><img src="../assets/images/logo.png" alt="" class="mx-auto" /></a>
            <p class="mt-5 fw-bold">HexShop Online Shopping is a free online for all
              <br>
              customers to purchase products.
              </br>
            </p>
          </div>
          <div class="text-danger text-center fw-bold">
            <p>
              <?= ($error == 1 ? "Invalid username or password!" : "") ?>
            </p>
          </div>
          <div class="mb-5">
            <label for="txtEmail" class="fw-bold">Email</label>
            <input type="email" name="txtEmail" id="txtEmail" value="<?php if (!empty($email)) {
                                                                        echo $email;
                                                                      } elseif (isset($_COOKIE['rememberEmail'])) {
                                                                        echo $_COOKIE['rememberEmail'];
                                                                      } ?>" class="form-control">
          </div>

          <div class="mb-5">
            <label for="txtPassword" class="fw-bold">Password</label>
            <input type="password" name="txtPassword" id="txtPassword" class="form-control">
          </div>

          <div class="d-flex justify-content-between mb-5 fw-bold">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="txtCheck" <?php if (!empty($remember)) { ?> checked <?php } elseif (isset($_COOKIE["remember"])) { ?> checked <?php } ?>>
              <label class="form-check-label" for="txtCheck">
                Remember Me
              </label>
            </div>
            <a href="#" class="fw-bold">Forget Password?</a>
          </div>

          <div class="mt-5 mb-5">
            <button type="submit" class="w-100 btn btn-primary button1-style fw-bold">Sign In</button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>