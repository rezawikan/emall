<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EMall | Reset password</title>

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

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">
                    <h2 class="font-bold">Reset Password</h2>
                    <p>Enter your new password and enjoy it.</p>
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="reset_password" class="m-t" role="form" method="POST">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" required>
                                    <input type="hidden" class="form-control" name="code" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="New Password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirmation New Password" name="confirm_password" required>
                                </div>
                                <button type="submit" class="btn btn-primary block full-width m-b ladda-button" name="btn-reset">Update New Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Emall, Inc
            </div>
            <div class="col-md-6 text-right">
               <small>© 2016</small>
            </div>
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

    <!-- Reset Password JS -->
    <script src="assets/js/custom/reset_password.js"></script>

</body>
</html>
