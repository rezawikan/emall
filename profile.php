<?php require_once 'templates/data.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Mall - Profile</title>

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

    <!-- FooTable -->
    <link rel="stylesheet" href="assets/css/plugins/footable/footable.core.css">

</head>
<body id="page-top" class="landing-page">

<?php require_once 'templates/header.php'; ?>

<section class="container top-container">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Profile</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="home.php">Home</a>
                </li>
                <li class="active">
                    <a><strong>Profile</strong></a>
                </li>
            </ol>
        </div>
    </div>
</section>
<section id="features" class="container bank">
    <div class="row">
        <div class="col-sm-5">
            <div class="ibox float-e-margins">

              <form id="form-profile" class="m-t" role="form" method="POST">
                <div class="form-group">
                    <label><h5>Update Your Profile</h5></label>
                    <div id="message"></div>
                </div>
                <div class="form-group">
                  <label>Profile Picture</label>
                  <input type="file" class="form-control" name="uploadedFiles">
                </div>
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control" placeholder="First Name" name="firstName" required>
                </div>
                <div id="firstName" class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control" placeholder="Last Name" name="lastName" required>
                </div>
                <div id="email" class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" placeholder="Email" name="email" required>
                </div>
                <div id="address" class="form-group">
                  <label>Address</label>
                  <textarea class="form-control" name="address" required></textarea>
                </div>
                <div id="province" class="form-group">
                  <label>Province</label>
                  <select name="province" class="form-control" tabindex="2" required>

                  </select>
                </div>
                <div id="city" class="form-group">
                  <label>City</label>
                  <select name="city" class="form-control" tabindex="2" required>

                  </select>
                </div>
                <div id="districts" class="form-group">
                  <label>District</label>
                  <select name="districts" class="form-control" tabindex="2" required>

                  </select>
                </div>
                <div id="postalCode" class="form-group">
                  <label>Postal Code</label>
                  <input type="text" class="form-control" placeholder="Postal Code" name="postalCode" required>
                </div>
                <div id="telpNumber" class="form-group">
                  <label>Telp Number</label>
                  <input type="text" class="form-control" placeholder="Telp Number" name="telpNum" required>
                </div>
                <button type="submit" class="btn btn-primary m-b ladda-button" name="btn-profile-update">Update</button>
              </form>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="ibox float-e-margins">
              <form id="form-change-password" class="m-t" role="form" method="POST">
                <div class="form-group">
                    <label><h5>Reset Your Password</h5></label>
                    <div id="message-password"></div>
                </div>
                <div class="form-group">
                  <label>New Password</label>
                  <input type="hidden" name="id" value="<?php echo $_SESSION["sellerSession"];?>" required>
                  <input type="password" class="form-control" placeholder="New Password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Confirmation New Password</label>
                    <input type="password" class="form-control" placeholder="Confirmation New Password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary m-b ladda-button" name="btn-change-password">Update</button>
              </form>
            </div>
        </div>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?>


<!-- Mainly scripts -->
<script src="assets/js/jquery-3.1.0.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="assets/js/inspinia.js"></script>
<script src="assets/js/plugins/pace/pace.min.js"></script>
<script src="assets/js/plugins/wow/wow.min.js"></script>

<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="assets/js/formValidation.min.js"></script>
<script src="assets/js/framework/bootstrap.min.js"></script>

<!-- Ladda -->
<script src="assets/js/plugins/ladda/spin.min.js"></script>
<script src="assets/js/plugins/ladda/ladda.min.js"></script>
<script src="assets/js/plugins/ladda/ladda.jquery.min.js"></script>

<!-- FooTable -->
<script src="assets/js/plugins/footable/footable.all.min.js"></script>

<!-- Handle CRUD Data Bank -->
<script src="assets/js/custom/profile.js"></script>

<!-- Custom Js -->
<script src="assets/js/custom/custom.js"></script>

</body>
</html>
