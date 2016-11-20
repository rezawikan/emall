<?php require_once 'templates/data.php'; ?>

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

    <!-- FormValidation CSS file -->
    <link rel="stylesheet" href="assets/css/formValidation.min.css">

    <!-- Ladda style -->
    <link rel="stylesheet" href="assets/css/plugins/ladda/ladda-themeless.min.css">

    <!-- FooTable -->
    <link rel="stylesheet" href="assets/css/plugins/footable/footable.core.css">

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
                <li class="active">
                    <a><strong>Products</strong></a>
                </li>
            </ol>
        </div>
    </div>
</section>
<section id="features" class="container services wow fadeInRight ">
  <div class="row products border-bottom flexs">
    <img id='loading-svg' class="img-responsive distance-bottom-image center-block" src="assets/img/hourglass.svg" />

    <!-- <div class="col-md-3">
        <div class="ibox">
            <div class="ibox-content product-box">
                <div class="product-imitation">
                    <img src="https://placeimg.com/260/200/any">
                </div>
                <div class="product-desc">
                    <span class="product-price">
                                $10
                    </span>
                    <small class="text-muted">Category</small>
                    <a href="#" class="product-name"> Product</a>
                    <div class="small m-t-xs">
                        Many desktop publishing packages and web page editors now.
                    </div>
                    <div class="m-t text-righ">
                        <a href="#" class="btn btn-xs btn-outline btn-primary">Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


  </div>
  <?php
      use Emall\Pagination\Pagination;
      use Emall\Auth\Session;
      use Emall\Auth\Filter;

      $page     = new Pagination;
      $sellerID = Session::get('sellerSession');

      if (isset($_GET['page'])) {
          if (!is_numeric($_GET['page'])){
              $page_number = 1;
          } else {
              $page_number = Filter::IntegerFilter($_GET['page']);
          }
      } else {
          $page_number = 1;
      }

      if (isset($_GET['limit'])) {
          if (!is_numeric($_GET['limit'])){
              $item_per_page = 24;
          } else {
              $item_per_page = Filter::IntegerFilter($_GET['limit']);
          }
      } else {
          $item_per_page = 24;
      }

      if (isset($_GET['subcategories'])) {
          if (!is_numeric($_GET['subcategories'])){
              $subcategories = null;
          } else {
              $subcategories = Filter::IntegerFilter($_GET['subcategories']);
          }
      } else {
          $subcategories = null;
      }

      if (is_null($subcategories)) {
          $total_records = $page->TotalRows($sellerID,$subcategories);
          $total_pages   = ceil($total_records/$item_per_page);
          echo $page->paginate_function($item_per_page, $page_number, $total_records, $total_pages,'product.php?page=');
          echo "string";
      } else {
          $total_records = $page->TotalRows($sellerID, $subcategories);
          $total_pages   = ceil($total_records/$item_per_page);
          echo $page->paginate_function($item_per_page, $page_number, $total_records, $total_pages,'product.php?page=','&subcategories=',$subcategories);
      }
  ?>
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

<!-- Handle View Data Product -->
<script src="assets/js/custom/product.js"></script>

<!-- Custom Js -->
<script src="assets/js/custom/custom.js"></script>

</body>
</html>
