<?php

  session_start();
  require_once 'vendor/autoload.php';

  use Emall\Auth\Authentication;
  use Emall\Auth\Token;

  $seller_login = new Authentication;

  if($seller_login->is_logged_in()){
      $seller_login->redirect("home.php");
  }

  ?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EMall | Login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Animation CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- FormValidation CSS file -->
    <link rel="stylesheet" href="assets/css/formValidation.min.css">

    <!-- Ladda style -->
    <link rel="stylesheet" href="assets/css/plugins/ladda/ladda-themeless.min.css">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">EM</h1>

            </div>
            <h3>Welcome to Electronic Mall</h3>
            <p>Login for User</p>
            <p id="message"></p>
            <form id="form-signin" class="m-t" role="form" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username or Email" name="username" required>
                </div>
                <div id="password" class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <input type="hidden" class="form-control" name="token" value="<?php echo Token::generateToken(); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b ladda-button" name="btn-login">Login</button>

                <a href="forgot_password.php"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="signup.php">Create an account</a>
            </form>
            <p class="m-t"> <small>E-Mall we app framework base on Bootstrap 3 &copy; 2016</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="assets/js/jquery-2.2.3.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- FormValidation plugin and the class supports validating Bootstrap form -->
    <script src="assets/js/formValidation.min.js"></script>
    <script src="assets/js/framework/bootstrap.min.js"></script>

     <!-- Ladda -->
    <script src="assets/js/plugins/ladda/spin.min.js"></script>
    <script src="assets/js/plugins/ladda/ladda.min.js"></script>
    <script src="assets/js/plugins/ladda/ladda.jquery.min.js"></script>

    <!-- Login JS-->
    <script src="js/login.js"></script>
</body>

</html>
