<?php require_once 'templates/data.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Mall - Bank Account</title>

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
            <h2>Bank Account</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="home.php">Home</a>
                </li>
                <li class="active">
                    <a><strong>Bank Account</strong></a>
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
                    <a id="add" data-toggle="modal" class="btn btn-primary distance-top" href="#modal-form-add" >Add</a>
                    <p id='message'></p>
                </div>
                  <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Bank Nama</th>
                          <th>Branch</th>
                          <th>Account Number</th>
                          <th>Owner</th>
                          <th colspan="2">Action</th>
                      </tr>
                      </thead>
                      <tbody id="table-bank">
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

    <!-- Start Modals Form Add Data Bank -->
    <div id="modal-form-add" class="modal fade" aria-hidden="true" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12"><h3 class="m-t-none m-b">Bank Account</h3>
                                        <p>Make sure your bank account</p>

                                        <form role="form" id="form-data-add" method="POST">
                                            <input type="hidden" value="<?php echo $id;?>" name="sellerID" class="form-control">
                                            <div class="form-group"><label>Bank Name</label>
                                                <select id="bankID" class="form-control m-b" name="bankID" id="bankID">
                                                    <option value="">Select</option>
                                                <?php

                                                    $seller->setTable('bank');
                                                    $banks = $seller->select()->all();
                                                    foreach ($banks as $bank) {
                                                ?>
                                                    <option value="<?php echo $bank->bankID; ?>"><?php echo $bank->bankName; ?></option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="form-group"><label>Account Number</label> <input type="text" placeholder="Account Number" name="accountNumber" class="form-control"></div>
                                            <div class="form-group"><label>Owner Name</label> <input type="text" placeholder="Owner Name" name="ownerName" class="form-control"></div>
                                            <div class="form-group"><label>Branch</label> <input type="text" placeholder="Branch" name="branch" class="form-control"></div>
                                            <button class="btn btn-sm btn-primary ladda-button" data-style="expand-right" type="submit" name="btn-add">OK</button>
                                            <button id="cancel-btn-add" class="btn btn-sm btn-primary " type="submit">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <!--End Modals Form Add Data Bank-->

    <!-- Start Modals Update Form Bank -->
    <div id="modal-form-update" class="modal fade" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12"><h3 class="m-t-none m-b">Edit Bank Account</h3>
                                        <p>Make sure your bank account</p>

                                        <form role="form" id="form-data-update" method="POST">
                                            <input type="hidden" name="Useller_bankID" class="form-control">
                                            <input type="hidden" name="UsellerID" class="form-control">
                                            <div class="form-group"><label>Bank Name</label>
                                                <select class="form-control m-b" name="UbankID" id="UbankID">
                                                <option value="">Select</option>
                                                <?php
                                                    foreach ($banks as $bank) {
                                                ?>
                                                    <option value="<?php echo $bank->bankID; ?>"><?php echo $bank->bankName; ?></option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                            <div id="UaccountNumber-group" class="form-group"><label>Account Number</label> <input type="text" placeholder="Account Number" name="UaccountNumber" class="form-control"></div>
                                            <div id="UownerName-group" class="form-group"><label>Owner Name</label> <input type="text" placeholder="Owner Name" name="UownerName" class="form-control"></div>
                                            <div id="Ubranch-group" class="form-group"><label>Branch</label> <input type="text" placeholder="Branch" name="Ubranch" class="form-control"></div>
                                            <button class="btn btn-sm btn-primary ladda-button" data-style="expand-right" type="submit" name="btn-update">Update</button>
                                            <button class="btn btn-sm btn-primary" type="reset">Reset</button>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <!--End Modals Update Form Bank-->

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
<script src="assets/js/custom/bank.js"></script>

<!-- Custom Js -->
<script src="assets/js/custom/custom.js"></script>

</body>
</html>
