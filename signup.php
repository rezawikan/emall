<!DOCTYPE html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EMall | Sign Up</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Animation CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

    <!-- Plugins CSS iCheck -->
     <link rel="stylesheet" href="assets/css/plugins/iCheck/custom.css">

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
            <h3>Register to EM</h3>
            <p>Create account to see it in action.</p>
            <div id="message">
                <!-- Message -->
            </div>
            <form id="form-signup" class="m-t" role="form" method="POST">
               <div id="email-group" class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="First Name" name="firstName">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Last Name" name="lastName">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                </div>
                <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox" name="agree" required><i></i> Agree the terms and policy </label></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b ladda-button"  data-style="expand-right" name="btn-signup">Sign Up</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login.php">Login</a>
            </form>
            <p class="m-t"> <small>E-Mall we app framework base on Bootstrap 3 &copy; 2016</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="assets/js/jquery-2.2.3.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- iCheck -->
    <script src="assets/js/plugins/iCheck/icheck.min.js"></script>

    <!-- FormValidation plugin and the class supports validating Bootstrap form -->
    <script src="assets/js/formValidation.min.js"></script>
    <script src="assets/js/framework/bootstrap.min.js"></script>

     <!-- Ladda -->
    <script src="assets/js/plugins/ladda/spin.min.js"></script>
    <script src="assets/js/plugins/ladda/ladda.min.js"></script>
    <script src="assets/js/plugins/ladda/ladda.jquery.min.js"></script>

    <!-- Handle Signup -->
    <script src="assets/js/custom/signup.js"></script>

</body>

</html>
