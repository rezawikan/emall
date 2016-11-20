$(document).ready(function() {

    $('.table').footable({
        "paging": {
            "enabled": true
        }
    });

    loadData();

    // cancel button form add
    $('#form-data-add #cancel-btn-add').on('click', function(e) {
        e.preventDefault();
        $('#modal-form-add').modal('hide');
    });

    // hide the first option select
    $("#form-data-update #bankID").on('click', function(e) {
        e.preventDefault();
        $("#form-data-update select option:first-child").hide();
    });

    // hide the first option select
    $("#form-data-update #bankID").on('click', function(e) {
        e.preventDefault();
        $("#form-data-update select option:first-child").hide();
    });

    // global hide
    $("#form-data-update #sellerID").hide();
    $("#form-data-add #sellerID").hide();
    $("#form-data-update #seller_bankID").hide();

    // get data cookie
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    // load data from table bank
    function loadData() {
        var dataID = getCookie('id');
        console.log(dataID);

        $.ajax({
            url: 'function/bank/ViewDataBank.php',
            type: 'POST',
            data: {
                sellerID: dataID
            },
            success: function(result) {
                console.log(result);
                var resultObj = JSON.parse(result);
                var number = 0;
                var dataHandler = $('#table-bank');
                dataHandler.html("");

                if (resultObj.empty) {
                    var emptyRow = $("<tr>");
                    emptyRow.html("<td colspan='6' style=' height:100px; padding-top:50px; text-align:center;'>You don't have account bank</td>");
                    dataHandler.append(emptyRow);
                } else {
                    $.each(resultObj, function(key, val) { // looping data
                        number++;
                        var newRow = $("<tr>");
                        newRow.html("<td>" + number + "</td><td>" + val.bankName + "</td><td>" + val.branch + "</td><td>" + val.accountNumber + "</td><td>" + val.ownerName + "</td><td><a data-toggle='modal' class='edit_bank' id='" + val.seller_bankID + "' href='#modal-form-update'><i title='Edit' class='fa fa-pencil'></i></a></td><td><a class='delete_bank' id='" + val.seller_bankID + "' href='javascript:void(0)'><i title='Delete' class='fa fa-trash'></i></a></td>");
                        dataHandler.append(newRow).trigger('footable_redraw');
                    })
                }
            }
        });
    }

    /// create a new instance for loading
    var l = Ladda.create(document.querySelector('button[name=submit-btn-add]'));
    // Form Validation add
    $('#form-data-add').formValidation({
            framework: 'bootstrap',
            fields: {
                bankID: {
                    validators: {
                        notEmpty: {
                            message: 'Bank is required'
                        }
                    }
                },
                accountNumber: {
                    validators: {
                        notEmpty: {
                            message: 'Account Number is required'
                        },
                        integer: {
                            message: "Account Number isn't valid"
                        }
                    }
                },
                ownerName: {
                    validators: {
                        notEmpty: {
                            message: 'Owner Name is required'
                        }
                    }
                },
                branch: {
                    validators: {
                        notEmpty: {
                            message: 'Branch is required'
                        }
                    }
                }
            } // end fields
        }) // end form validation
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Some instances you can use are
            var $form = $(e.target), // The form instance
                fv = $(e.target).data('formValidation'); // FormValidation instance

            // start loading animation
            l.start();

            $.ajax({
                url: 'function/bank/AddDataBank.php',
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                        console.log(result);
                        var resultObj = JSON.parse(result);
                        console.log(resultObj);

                        l.stop();
                        $form.formValidation('resetForm', true);
                        $('#form-data-add')[0].reset(); // reset all fields
                        $('#form-data-add').children().removeClass('has-success'); // remove class has-success
                        $('button').removeAttr('disabled'); // remove atrribute disabled
                        $('button').removeClass('disabled'); // remove class disabled
                        $('#modal-form-add').modal('hide'); // hide modal form add
                        loadData(); // load data

                        if (resultObj.valid) {
                            $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>" + resultObj.valid + "</div>");
                            $('#message').fadeIn('slow', function() {
                                $('#message').fadeOut(7000);
                            });
                        } else if (resultObj.error) {
                            $('#message').html("<div class='alert alert-danger alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>" + resultObj.error + "</div>");
                            $('#message').fadeIn('slow', function() {
                                $('#message').fadeOut(7000);
                            });
                        }
                    } // end success
            }); // end ajax
        });

    // edit bank show when click action edit
    $(document).on('click', '.edit_bank', function(e) {
        e.preventDefault();

        var dataID = $(this).attr('id'); // get data from attribute id

        $.ajax({
            url: 'function/bank/EditDataBank.php',
            type: 'POST',
            data: {
                seller_bankID: dataID
            },
            success: function(result) {
                var resultObj = JSON.parse(result);
                console.log(resultObj);

                // replace data that loaded to form
                $('#form-data-update input[name=seller_bankID]').val(resultObj.seller_bankID);
                $('#form-data-update input[name=sellerID]').val(resultObj.sellerID);
                $('#form-data-update select[name=bankID]').val(resultObj.bankID);
                $('#form-data-update input[name=accountNumber]').val(resultObj.accountNumber);
                $('#form-data-update input[name=ownerName]').val(resultObj.ownerName);
                $('#form-data-update input[name=branch]').val(resultObj.branch);
            }
        })
    });

    // create a new instance for loading
    var u = Ladda.create(document.querySelector('button[name=submit-btn-update]'));
    // form validation update
    $('#form-data-update').formValidation({
            framework: 'bootstrap',
            fields: {
                bankID: {
                    validators: {
                        notEmpty: {
                            message: 'Bank is required'
                        }
                    }
                },
                accountNumber: {
                    validators: {
                        notEmpty: {
                            message: 'Account Number is required'
                        },
                        integer: {
                            message: "Account Number is'nt valid"
                        }
                    }
                },
                ownerName: {
                    validators: {
                        notEmpty: {
                            message: 'Owner Name is required'
                        }
                    }
                },
                branch: {
                    validators: {
                        notEmpty: {
                            message: 'Branch is required'
                        }
                    }
                }
            } // fields
        }) // form validation
        .on('success.form.fv', function(e) {
            e.preventDefault(); // prevent form submission

            u.start();

            var $form = $(e.target), // The form instance
                fv = $(e.target).data('formValidation'); // FormValidation instance

            $.ajax({
                url: 'function/bank/UpdateDataBank.php',
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                        console.log(result);
                        var resultObj = JSON.parse(result);
                        console.log(resultObj);
                        u.stop();
                        $form.formValidation('resetForm', true);
                        $('#form-data-update')[0].reset(); // reset all fields
                        $('#form-data-update').children().removeClass('has-success'); // remove class has-success
                        $('button').removeAttr('disabled'); // remove atrribute disabled
                        $('button').removeClass('disabled'); // remove class disabled
                        loadData(); // load data
                        $('#modal-form-update').modal('hide'); // hide modal form add

                        if (resultObj.valid) {
                            $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>" + resultObj.valid + "</div>");
                            $('#message').fadeIn('slow', function() {
                                $('#message').fadeOut(7000);
                            });
                        }
                    } // end success
            }); // end ajax
        });

    // delete data bank
    $(document).on('click', '.delete_bank', function(e) {
        e.preventDefault(); /* prevent link address */
        var dataID = $(this).attr('id'); /* get data id */

        $("#confirm").html("Are you sure want to delete?"); /* pop up modals confirmation */
        $('#modal-form-delete').modal('show');
        $('#cancel').click(function() {

            $('#modal-form-delete').modal('hide');
        });

        $('#sure').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'function/bank/DeleteDataBank.php',
                type: 'POST',
                data: {
                    seller_bankID: dataID
                },
                success: function(result) {
                    var resultObj = JSON.parse(result);
                    console.log(result);
                    $('#modal-form-delete').modal('hide'); // hide modal form add
                    if (resultObj.valid) {
                        $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>" + resultObj.valid + "</div>");
                        $('#message').fadeIn('slow', function() {
                            $('#message').fadeOut(7000);
                        });
                        loadData();
                    }
                }
            }); // end ajax
        }); // end sure
    }); // end delete
});
