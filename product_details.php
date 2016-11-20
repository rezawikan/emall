<?php require_once 'templates/data.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Mall - Manage Products</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Animation CSS -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- slick -->
    <link href="assets/css/plugins/slick/slick.css" rel="stylesheet">
    <link href="assets/css/plugins/slick/slick-theme.css" rel="stylesheet">

</head>

<?php require_once 'templates/header.php'; ?>

<section class="container top-container">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Products</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="home.php">Home</a>
                </li>
                <li>
                    <a href="manage_products.php">Manage Products</a>
                </li>
                <li class="active">
                    <a><strong>Products Details</strong></a>
                </li>
            </ol>
        </div>
    </div>
</section>
<section id="features" class="container wow fadeInRight ">
  <div class="row products border-bottom">
    <img id='loading-svg' class="img-responsive distance-bottom-image distance-top-image center-block" src="assets/img/hourglass.svg" />
    <div class='col-lg-4'>
        halasodakdasdasd
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

<!-- slick carousel-->
<script src="assets/js/plugins/slick/slick.min.js"></script>

<!-- Handle View Data Product -->
<script src="assets/js/custom/product_details.js"></script>

<!-- Custom Js -->
<script src="assets/js/custom/custom.js"></script>


</body>
</html>
