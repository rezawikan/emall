<?php
    require_once 'autoloader.php';

    $newSeller = new Authentication();

    if(empty($_GET)){
        $newSeller->redirect('index.php');
    }else if(isset($_GET['success'])){
            $msg =  "
                    <div class='alert alert-success'>
                        <p>Your Password was <strong>RESET</strong> Now!<p>
                        <p>Please Login in <a class='alert-link link-under' href='login.php'>here</a>.</p>
                    </div>
                ";
    }else if(isset($_GET['used'])){
            $msg =  "
                    <div class='alert alert-success'>
                        <p>This link was <strong>USED!</strong><p>
                        <p>Please, go to <a class='alert-link link-under' href='forgot_password.php'>forgot password page</a>.</p>
                    </div>
                ";
    }else if(isset($_GET['notfound'])){
            $msg =  "
                    <div class='alert alert-success'>
                        <p>Not <strong>Found!</strong><p>
                        <p>Please, go to <a class='alert-link link-under' href='forgot_password.php'>forgot password page</a>.</p>
                    </div>
                ";
    }
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Animation CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">DM</h1>

            </div>
            <h3>Welcome to Electronic Mall</h3>
            <?php if(isset($msg)) echo $msg;  ?>
            <p class="m-t"> <small>e-Commerce we app framework base on Bootstrap 3 &copy; 2016</small> </p>
        </div>
    </div>

   <!-- Mainly scripts -->
    <script src="assets/js/jquery-3.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>
