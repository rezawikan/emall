$(document).ready(function() {

    $('.table').footable({
        "paging": {
            "enabled": true
        }
    });

    loadBank('select[name=seller_bankID]');
    loadWithdrawal();

    $("select").on('click', function(e) {
        e.preventDefault();
        $("select option:first-child").hide();
    });

    $('#cancel-btn-withdrawal').on('click', function(e) {
        e.preventDefault();
        $('#modal-form-withdrawal').modal('hide');
    });

    $('input[name=amount]').keyup(function(event) {
        $(this).val(number_format($(this).val()));
    });

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

    function loadBank() {
        $('input[name=accountNumber]').hide();
        $('input[name=ownerName]').hide();
        $('input[name=branch]').hide();
        $('label[for=branch]').hide();
        $('label[for=accountNumber]').hide();
        $('label[for=ownerName]').hide();

        var dataID = getCookie('id');
        //console.log(dataID);

        $.ajax({
            url: 'function/withdrawal/selectBank.php',
            type: 'POST',
            data: {
                sellerID: dataID
            },
            success: function(result) {
                //console.log(result);

                var resultObj = JSON.parse(result);

                var option = $('select[name=seller_bankID]');

                $.each(resultObj, function(key, val) {
                    console.log(key);
                    console.log(val);
                    var dataOption;
                    dataOption = '<option value="' + val.seller_bankID + '">' + val.bankName + '</option>';
                    option.append(dataOption);

                });
            }
        });
    }

    function selectDataBank(value) {
        var dataID = getCookie('id');
        // console.log(dataID);

        $.ajax({
            url: 'function/withdrawal/selectDataBank.php',
            type: 'POST',
            data: {
                sellerID: dataID,
                seller_bankID: value
            },
            success: function(result) {
                console.log(result);

                var resultObj = JSON.parse(result);
                $('input[name=bankName]').val(resultObj[0]['bankName']);
                $('input[name=accountNumber]').val(resultObj[0]['accountNumber']);
                $('input[name=branch]').val(resultObj[0]['branch']);
                $('input[name=ownerName]').val(resultObj[0]['ownerName']);
            }
        });

    }

    $('select[name=seller_bankID]').change(function() {
        $('input[name=accountNumber]').show();
        $('input[name=ownerName]').show();
        $('input[name=branch]').show();
        $('label[for=accountNumber]').show();
        $('label[for=ownerName]').show();
        $('label[for=branch]').show();
        var bankSelect = $('select[name=seller_bankID]').val();
        //console.log(bankSelect);
        selectDataBank(bankSelect);

    });

    var a = Ladda.create(document.querySelector('button[name=submit-btn-add] '));
    $('#form-data-add').formValidation({
            framework: 'bootstrap',
            fields: {
                seller_bankID: {
                    validators: {
                        notEmpty: {
                            message: 'Bank is required'
                        }
                    }
                },
                amount: {
                    validators: {
                        notEmpty: {
                            message: 'Amount is required'
                        }
                    }
                }
            } // end fields
        }) // end form validation
        .on('success.form.fv', function(e) {
            e.preventDefault(); // prevent form submission
            // fv.defaultSubmit();
        });

    // Custom submit handler
    $('#form-data-add').submit(function(e) {
        a.start();
        // You can get the form instance
        var $form = $(e.target);

        // and the FormValidation instance
        var fv = $form.data('formValidation');

        $.ajax({
                url: 'function/withdrawal/AddDataWithdrawal.php',
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                    var resultObj = JSON.parse(result);
                    console.log(resultObj);
                    a.stop();
                    $form.formValidation('resetForm', true);
                    $('#form-data-add')[0].reset(); // reset all fields
                    $('#form-data-add').children().removeClass('has-success'); // remove class has-success
                    $('button').removeAttr('disabled'); // remove atrribute disabled
                    $('button').removeClass('disabled'); // remove class disabled
                    loadWithdrawal();
                    loadBank('select[name=seller_bankID]');
                    $('#modal-form-withdrawal').modal('hide');

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
                }
            })
            .fail(function() {
                console.log("error");
            })
    });

    function loadWithdrawal() {

        var dataID = getCookie('id');
        //console.log(dataID);

        $.ajax({
                url: 'function/withdrawal/ViewDataWithdrawal.php',
                type: 'POST',
                data: {
                    sellerID: dataID
                },
                success: function(result) {
                    console.log(result);
                    var resultObj = JSON.parse(result);
                    var number = 0;
                    var dataHandler = $('#table-withdrawal');

                    dataHandler.html("");

                    if (resultObj.empty) {
                        var emptyRow = $("<tr>");
                        emptyRow.html("<td colspan='6' style=' height:100px; padding-top:50px; text-align:center;'>You don't have request withdrawal</td>");
                        dataHandler.append(emptyRow);
                    } else {
                        $.each(resultObj, function(index, val) {
                            /* iterate through array or object */
                            number++;
                            var newRow = $("<tr>");
                            newRow.html("<td>" + number + "</td><td>" + number_format(val.amount) + "</td><td>" + val.bankName + "</td><td>" + val.accountNumber + "</td><td>" + val.statusWithdrawal + "</td><td>" + val.update_at+ "</td>");
                            dataHandler.append(newRow).trigger('footable_redraw');
                        });
                    }
                }
            })
            .fail(function() {
                console.log("error");
            });
    }

    function number_format(user_input) {
        var filtered_number = user_input.replace(/[^0-9]/gi, '');
        var length = filtered_number.length;
        var breakpoint = 1;
        var formated_number = '';

        for (i = 1; i <= length; i++) {
            if (breakpoint > 3) {
                breakpoint = 1;
                formated_number = '.' + formated_number;
            }
            var next_letter = i + 1;
            formated_number = filtered_number.substring(length - i, length - (i - 1)) + formated_number;

            breakpoint++;
        }

        return formated_number;
    }
});
