$(document).ready(function() {

    // function get value from adrress
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    // get id and code from address
    var dataID = getParameterByName('id');
    var code = getParameterByName('code');

    // put value to form
    $('input[name=id]').val(dataID);
    $('input[name=code]').val(code);

    if (dataID == null && code == null) {
        //console.log(' data is empty');
        window.location = 'index.php';
    } else {
        $.ajax({
            url: 'function/auth/checkPassword.php',
            type: 'POST',
            data: {
                dataID, code
            },
            success: function(result) {
                    // console.log(result);
                    // parse result to JSON format
                    var resultObj = JSON.parse(result);

                    if (resultObj.status == 'notfound') {
                        window.location = 'notif.php?notfound';
                        //console.log('notfound');
                    } else if (resultObj.status == 'used') {
                        window.location = 'notif.php?used';
                        //console.log('used');
                    } else if (resultObj.status == 'none') {
                        console.log('none');
                    }
                } // end result
        }); // end ajax
    }

    // create a new instance for loading
    var l = Ladda.create(document.querySelector('button[name=btn-reset]'));

    $("#reset_password").formValidation({
            framework: 'bootstrap',
            fields: {
                password: {
                    threshold: 5,
                    validators: {
                        notEmpty: {
                            message: 'New password is required'
                        }, // end not empty
                        stringLength: {
                            min: 8,
                            message: 'The password must be more than 8 characters long'
                        } // end string length
                    } //end validators
                }, // end password
                confirm_password: {
                    validators: {
                        notEmpty: {
                            message: 'Confirm new password is required'
                        }, // end not empty
                        identical: {
                            field: 'password',
                            message: 'The new password and its confirm are not the same'
                        } // end identical
                    } // end validators
                } //end confirm_password
            } // end fields
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv = $form.data('formValidation');

            // start button loading
            l.start();

            $.ajax({
                    url: 'function/auth/resetPassword.php',
                    type: 'POST',
                    data: $form.serialize(),
                    success: function(result) {
                        //console.log(result);
                        // parse result to JSON format
                        var resultObj = JSON.parse(result);

                        if (resultObj.status == 'success') {
                            window.location = "notif.php?success";
                            //console.log('status berasil');
                        }
                        // stop button loading
                        l.stop();
                    }
                }) // end ajax
        }); //  end succes
});
