<?php require_once 'views/data.php'; ?>

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

<?php require_once 'views/header.php'; ?>

<section class="container top-container">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Products</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="home.php">Home</a>
                </li>
                <li class="active">
                    <a><strong>Manage Products</strong></a>
                </li>
            </ol>
        </div>
    </div>
</section>
<section id="features" class="container bank">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div>
                    <a id="add" class="btn btn-primary distance-top" href="add_product.php" >Add Product</a>
                    <p id='message'></p>
                </div>
                  <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Categories</th>
                          <th>Images</th>
                          <th>Product Name</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Weight</th>
                          <th colspan="2">Action</th>
                      </tr>
                      </thead>
                      <tbody id="table-products">
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="7">
                            <ul class="pagination pull-right"></ul>
                          </td>
                        </tr>
                      </tfoot>
                  </table>
            </div>
        </div>
    </div>


    <!-- Starts Modals Confirmation Delete -->
    <div id="modal-form-delete" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12"><h3 class="m-t-none m-b">Delete Confirmation</h3>
                        <div id="confirm"></div>
                            <div>
                              <button id="sure" type="button" class="btn btn-primary">Ok</button>
                              <button id="cancel" type="button" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modals Confirmation Delete-->
</section>

<?php require_once 'views/footer.php'; ?>

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
<script src="js/manage_products.js"></script>

<!-- Custom Js -->
<script src="js/custom.js"></script>

</body>
</html>
