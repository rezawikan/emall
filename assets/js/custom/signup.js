$(document).ready(function() {
    $('.i-checks').icheck( {
        tap: true, checkboxClass: 'icheckbox_square-green', radioClass: 'iradio_square-green', increaseArea: '20%' // optional
    }
    ) .on('ifChanged', function(e) {
        // Get the field name
        var field=$(this).attr('name');
        $('.i-checks').formValidation('revalidateField', field);
    }
    );
    // create a new instance for loading
    var l=Ladda.create(document.querySelector('button[name=btn-signup]'));
    $('#form-signup').formValidation( {
        framework: 'bootstrap', fields: {
            email: {
                verbose: false, validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    }
                    , emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                    , remote: {
                        async: true, url: 'function/auth/checkEmail.php', type: 'POST', data: {
                            type: 'email'
                        }
                        , message: 'The email already used'
                    } // end remote
                } // end validators
            }
            , // end email
            username: {
                verbose: false, validators: {
                    notEmpty: {
                        message: 'The username is required'
                    }
                    , stringLength: {
                        min: 6, max: 30, message: 'The username must be more than 6 and less than 30 characters long'
                    }
                    , regexp: {
                        regexp: /^[a-z0-9_]+$/, message: 'The username can only consist of alphabetical lower case, number, and underscore'
                    }
                    , remote: {
                        async: true, url: 'function/auth/checkUser.php', type: 'POST', data: {
                            type: 'username'
                        }
                        , message: 'The username already used'
                    } // end remote
                } // end validators
            }
            , // end username
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                    , different: {
                        field: 'username', message: 'The password cannot be the same as username'
                    }
                    , stringLength: {
                        min: 8, message: 'The password must be more than 8 characters long'
                    } // end string length
                } // end validators
            }
            , // end password
            confirm_password: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
                    }
                    , identical: {
                        field: 'password', message: 'The password and its confirm are not the same'
                    }
                } // end validators
            }
            , // end confirm password
            firstName: {
                validators: {
                    notEmpty: {
                        message: 'The Firt Name is required'
                    }
                    ,
                } // end validators
            }
            , // end confirm password
            lastName: {
                validators: {
                    notEmpty: {
                        message: 'The Last Name is required'
                    }
                    ,
                } // end validators
            }
            , // end confirm password
            agree: {
                validators: {
                    notEmpty: {
                        message: 'You must agree with the terms and conditions'
                    }
                } // end validators
            } // end agree checkbox
        } // end fiedls
    }
    ) .on('success.form.fv', function(e) {
        // Prevent form submission
        e.preventDefault();
        var $form=$(e.target), fv=$form.data('formValidation');
        // start button loading
        l.start();
        // Use Ajax to submit form data
        $.ajax( {
            url: 'function/auth/registerUser.php', type: 'POST', data: $form.serialize(), success: function(result) {
                // ... Process the result ..
                var resultObj=JSON.parse(result);
                // console.log(resultObj); // log processing
                if(resultObj.process=='success') {
                    $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button><strong>Success!</strong>  We've sent an email to "+resultObj.email+". Please click on the confirmation link in the email to create your account.</div>");
                }
                else {
                    $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>Something Wrong!!</div>");
                }
                $form.formValidation('resetForm', true);
                $('.i-checks').icheck('unchecked');
                // stop button loading
                l.stop();
            }
        }
        ); // end ajax
    }
    ); // end success
}

);
