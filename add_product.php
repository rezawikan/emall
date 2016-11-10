<?php require_once 'templates/data.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Mall - Add Product</title>

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

<?php require_once 'templates/header.php'; ?>

<section class="container top-container">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Add Product</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="home.php">Home</a>
                </li>
                <li>
                    <a href="manage_products.php">Manage Products</a>
                </li>
                <li class="active">
                    <a><strong>Add Product</strong></a>
                </li>
            </ol>
        </div>
    </div>
</section>
<section id="features" class="container">
  <div class="row">
      <div class="col-sm-8">
        <div class="ibox float-e-margins">
          <div class="distance-top">
              <div id="message"></div>
              <p>Make sure your details product</p>
          </div>
        </div>

        <!-- Form Data Product -->
        <?php require_once 'templates/part/form-data-product.php'; ?>

      </div>
      <div class="col-sm-1">

      </div>
      <div class="col-sm-3">
        <div class="ibox float-e-margins">
          <div class="distance-top">
            <p>Please read this notice</p>
          </div>

          <h4>Images</h4>
          <ul class="list-group">
            <li class="list-group-item">JPG/JPEG/PNG</li>
            <li class="list-group-item">Less 2MB</li>
            <li class="list-group-item">Good Quality Image</li>
            <li class="list-group-item">Clear Image</li>
          </ul>
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

<!-- Handle CRUD Data Bank -->
<script src="assets/js/custom/add_product.js"></script>

<!-- Custom Js -->
<script src="assets/js/custom/custom.js"></script>

</body>
</html>
