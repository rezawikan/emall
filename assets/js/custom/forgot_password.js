$(document).ready(function() {

    // create a new instance for loading
    var l = Ladda.create(document.querySelector('button[name=btn-email]'));

    $('#form-forgotPassword').formValidation({
            framework: 'bootstrap',
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required'
                        },
                        emailAddress: {
                            message: 'The email is not valid'
                        }
                    }
                } //  end email
            } // end fields
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

        }); //  end succes

    $('#form-forgotPassword').submit(function(e) {
        // You can get the form instance
        var $form = $(e.target);

        // and the FormValidation instance
        var fv = $form.data('formValidation');

        // Do whatever you want here ...
        // start button loading
        l.start();

        $.ajax({
                url: 'function/auth/forgotPassword.php',
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                    console.log(result);

                    // parse result to JSON format
                    var resultObj = JSON.parse(result);

                    // notif sent
                    if (resultObj.sent) {
                        $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>" + resultObj.sent + " and login in <a href='login.php'>here</a></div>");
                    }
                    // notif suspend
                    else if (resultObj.suspend) {
                        $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button><strong>Sorry, </strong>" + resultObj.suspend + ". Please contact administrator in <a href='contact_us.php'>here</a></div>");
                    }
                    // notif not found
                    else if (resultObj.notfound) {
                        $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button><strong>Sorry, </strong>" + resultObj.notfound + ". Please, sign up in <a href='signup.php'>here</a></div>");
                    }
                    // notif something wrong
                    else {
                        $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button><strong>Something wrong!</strong>  Back in <a href='index.php'>here</a></div></div>");
                    }

                    // stop button loading
                    l.stop();
                }
            }) // end ajax
    });
});
