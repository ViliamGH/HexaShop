<?php
$enable = "0";
$lastlogin = "";
$conn = mysqli_connect("127.0.0.1", "root", "", "a2");
if (isset($_POST['submit'])) {
    $email = $_POST['forEmail'];
    $password = $_POST['forPassword'];
    $confirmPassword = $_POST['forConfirmPassword'];
    $username = $_POST['forUsername'];
    $role = $_POST['cboRole'];
    $enable = $_POST['txtCheck'];
    if (isset($_POST['txtCheck'])) {
        $enable = "1";
    }
    if ($_POST['cboRole'] == "on")
        $role = "Admin";
    else
        $role = "User";
    if (isset($_POST['txtCheck'])) {
        $enable = "1";
    }
    $result = mysqli_query($conn, "Select * From tbuser Where Username = '$username' Or Email = '$email'");
    if (mysqli_num_rows($result) > 0) {
        echo "<script> alert('Username or Email Has Already Registered.'); </script>";
    } else {
        if ($password == $confirmPassword) {
            $sql = "Insert Into tbuser Values ('','$email',md5('$password'),'$username','$enable','$role','$lastlogin')";
            mysqli_query($conn, $sql);
            echo "<script> alert('Register Successfully.'); </script>";
        } else {
            echo "<script> alert('Password dose not matched.'); </script>";
        }
    }
}
?>
<!-- Main Content -->
<section class="container-fluid d-flex justify-content-center align-items-center border border-dark border-3 w-75" style="margin-top: 90px; font-weight: bold; color: #000;">
    <div class="row">
        <div class="col-12">
            <!-- form -->
            <form action="" method="POST" enctype="multipart/form-data" ​​autocomplete="off">
                <div class="text-center mb-3 ">
                    <a href="" class="py-4 block"><img src="assets/images/logo.png" alt="" class="mx-auto" /></a>
                    <p class="mt-5 mb-5">HexShop Online Shopping is a free online for all
                        <br>
                        customers to purchase products.
                        </br>
                    </p>
                </div>
                <!-- username -->
                <div class="mb-5">
                    <label for="forUsername">Username</label>
                    <input required type="text" id="forUsername" name="forUsername" class="form-control">
                </div>
                <!-- Email -->
                <div class="mb-5">
                    <label for="forEmail">Email
                        Address</label>
                    <input required type="email" id="forEmail" name="forEmail" class="form-control">
                </div>
                <!-- password -->
                <div class="mb-5">
                    <label for="forPassword">Password</label>
                    <input required type="password" id="forPassword" name="forPassword" class="form-control">
                </div>
                <!-- password -->
                <div class="mb-5">
                    <label for="forConfirmPassword">Re-Password</label>
                    <input required type="password" id="forConfirmPassword" name="forConfirmPassword" class="form-control">
                </div>
                <!-- Role -->
                <div class="mb-5 d-flex justify-content-between w-75 ">
                    Role:
                    <div class="form-check">
                        <input required class="form-check-input" value="on" type="radio" name="cboRole" id="cboRoles">
                        <label class="form-check-label" for="cboRoles">
                            Admin
                        </label>
                    </div>
                    <div class="form-check">
                        <input required class="form-check-input" value="off" type="radio" name="cboRole" id="cboRoless">
                        <label class="form-check-label" for="cboRoless">
                            User
                        </label>
                    </div>
                </div>
                <div class="mb-5 form-check form-switch ">
                    <input required class="form-check-input" type="checkbox" role="switch" id="txtCheck" name="txtCheck" <?= $enable == "0" ? "checked" : "" ?>>
                    <label class="form-check-label" for="txtCheck">Enable</label>
                </div>
                <!-- button -->
                <div class="mb-3">
                    <button type="submit" name="submit" class="w-100 btn btn-primary button1-style ">Sign In</button>
                </div>

            </form>
        </div>
</section>