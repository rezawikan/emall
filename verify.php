<?php
    require_once 'vendor/autoload.php';

    use Emall\Auth\Authentication;

    $user = new Authentication;

    if(empty($_GET['id']) && empty($_GET['code'])){
        $user->redirect('index.php');
    }else if(isset($_GET['id']) && isset($_GET['code'])){
        $id = base64_decode($_GET['id']);
        $code = ($_GET['code']);

        if($user->verify($id, $code) == true){
            $msg =  "
                    <div class='alert alert-success'>
                        <p>Your Account is <strong>ACTIVE</strong> Now!<p>
                        <p>Please Login in <a class='alert-link link-under' href='login.php'>here</a>.</p>
                    </div>
                ";
        }else{
            $msg =  "
                    <div class='alert alert-info'>
                        <p>Your Account already <strong>ACTIVE</strong><p>
                        <p>Please Login in <a class='alert-link link-under' href='login.php'>here</a>.</p>
                    </div>
                ";
        }
    }
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-Mall | Sign In</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">EM</h1>

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
