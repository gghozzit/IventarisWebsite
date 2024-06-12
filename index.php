<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style_1.css">
  <title>IBM UIN SUKA</title>
</head>
<body style="background: url('img/bg.png') no-repeat center; background-size: cover; font-family: sans-serif;">
  <div class="login-wrapper">
    <form action="" method="POST" class="form">
      <img src="img/Profile_UIN-01.png" alt="">
      <h2>Login</h2>
      <div class="input-group">
        <input required type="text" name="username" id="username" autocomplete="off" required>
        <label for="username">Username</label>
      </div>
      <div class="input-group">
        <input required type="password" name="password" id="password" required>
        <label for="password">Password</label>
      </div>
      <button name= "btnLogin" type="submit" class="submit-btn">Login</button>
    </form>
  </div>
  <script src="vendor/jquery-3.2.1.min.js"></script>

    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>

    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="js/sweetalert.min.js"></script>

    <script src="js/main.js"></script>
    <?php include "includes/alert.php"; ?>
</body>
</html>

<?php 
    include "includes/controller.php";
    session_start();
    $lg = new lsp();
    
    if($lg->sessionCheck() == "true"){
        if($_SESSION['level'] == "admin"){
            header("location:admin.php");
        }else if($_SESSION['level'] == "petugas"){
            header("location:petugas.php");
        }
    }

    if (isset($_POST['btnLogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($response = $lg->login($username, $password)) {
            if ($response['response'] == "positive") {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['level'] = $response['level'];
                if ($response['level'] == "admin") {
                    $response = $lg->redirect("admin.php");
                }else if ($response['level'] == "petugas") {
                    $response = $lg->redirect("petugas.php");
                }
            }
        }
    }

 ?>