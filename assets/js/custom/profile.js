$(document).ready(function() {

    loadProvince('select[name=province]');
    loadData();

    $('select[name=province]').on('click', function(e) {
        e.preventDefault();
        $('select[name=province] option:first-child').hide();
    });
    $('select[name=city]').on('click', function(e) {
        e.preventDefault();
        $('select[name=city] option:first-child').hide();
    });
    $('select[name=districts]').on('click', function(e) {
        e.preventDefault();
        $('select[name=districts] option:first-child').hide();
    });

    $('select[name=province]').change(function() {
        $('#city').show();
        $('select[name=districts]').val('');
        var idProvince = $('select[name=province]').val();
        loadCity(idProvince, 'select[name=city]');
    });

    $('select[name=city]').change(function() {
        $('#districts').show();
        var idCity = $('select[name=city]').val();
        console.log(idCity);
        loadDistricts(idCity, 'select[name=districts]');
    });

    function loadProvince(id, loadID) {
        $('#city').hide();
        $('#districts').hide();

        $.ajax({
            url: 'function/shipment/process.php?action=showAllProvince',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $(id).html('<option value="">Select</option>');
                var province = '';
                $.each(response['rajaongkir']['results'], function(key, val) {
                    if (loadID == val['province_id']) {
                        province = '<option selected value="' + val['province_id'] + '" >' + val['province'] + '</option>';
                    } else {
                        province = '<option value="' + val['province_id'] + '" >' + val['province'] + '</option>';
                    }
                    $(id).append(province);
                });
            }
        }).fail(function() {
            console.log("error");
        })
    }

    function loadCity(idProvince, id, loadID) {
        $.ajax({
                url: 'function/shipment/process.php?action=showAllCity',
                dataType: 'json',
                data: {
                    province: idProvince
                },
                success: function(response) {

                    $(id).html('<option value="">Select</option>');
                    var city = '';
                    $.each(response['rajaongkir']['results'], function(key, val) {

                        if (loadID == val['city_id']) {
                            city = '<option selected value="' + val['city_id'] + '" >' + val['city_name'] + '</option>';
                        } else {
                            city = '<option value="' + val['city_id'] + '" >' + val['city_name'] + '</option>';
                        }

                        $(id).append(city);
                    });
                }
            })
            .fail(function() {
                console.log("error");
            });
    }

    function loadDistricts(idCity, id, loadID) {

        $.ajax({
                url: 'function/shipment/process.php?action=showAllDistricts',
                dataType: 'json',
                data: {
                    city: idCity
                },
                success: function(response) {

                    $(id).html('');
                    $(id).html('<option value="">Select</option>');
                    var districts = '';
                    $.each(response['rajaongkir']['results'], function(key, val) {
                        if (loadID == val['subdistrict_id']) {
                            districts = '<option selected value="' + val['subdistrict_id'] + '" >' + val['subdistrict_name'] + '</option>';
                        } else {
                            districts = '<option value="' + val['subdistrict_id'] + '" >' + val['subdistrict_name'] + '</option>';
                        }
                        $(id).append(districts);
                    });
                }
            })
            .fail(function() {
                console.log("error");
            });
    }

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

    function loadData() {
        var dataID = getCookie('id');

        $.ajax({
            url: 'function/user/ViewDataProfile.php',
            type: 'POST',
            data: {
                sellerID: dataID
            },
            success: function(result) {
                var resultObj = JSON.parse(result);
                if (resultObj.province) {
                    loadProvince('select[name=province]', resultObj.province);
                    loadCity(resultObj.province, 'select[name=city]', resultObj.city);
                    loadDistricts(resultObj.city, 'select[name=districts]', resultObj.districts);
                    $('#city').show();
                    $('#districts').show();
                }

                $('input[name=firstName]').val(resultObj.firstName);
                $('input[name=lastName]').val(resultObj.lastName);
                $('input[name=email]').val(resultObj.email);
                $('textarea[name=address]').val(resultObj.address);
                $('input[name=postalCode]').val(resultObj.postalCode);
                $('input[name=telpNum]').val(resultObj.telpNumber);
            }
        });
    }

    // create a new instance for loading
    var l = Ladda.create(document.querySelector('button[name=btn-profile-update]'));

    $('#form-profile').formValidation({
            framework: 'bootstrap',
            fields: {
                uploadedFiles: {
                    validators: {
                        file: {
                            extension: 'jpeg,jpg,png',
                            type: 'image/jpeg,image/png',
                            maxSize: 2097152, // 2048 * 1024
                            message: 'The selected file is not valid'
                        }
                    }
                },
                firstName: {
                    validators: {
                        notEmpty: {
                            message: 'First Name is required'
                        }
                    }
                },
                lastName: {
                    validators: {
                        notEmpty: {
                            message: 'Last Name is required'
                        },
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
                        },
                        emailAddress: {
                            message: 'Email is not valid'
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: 'Address is required'
                        }
                    }
                },
                province: {
                    validators: {
                        notEmpty: {
                            message: 'Province is required'
                        }
                    }
                },
                city: {
                    validators: {
                        notEmpty: {
                            message: 'City is required'
                        }
                    }
                },
                districts: {
                    validators: {
                        notEmpty: {
                            message: 'Districts is required'
                        }
                    }
                },
                postalCode: {
                    validators: {
                        notEmpty: {
                            message: 'Postal Code is required'
                        },
                        integer: {
                            message: 'Postal Code is not valid',
                        }
                    }
                },
                telpNum: {
                    validators: {
                        notEmpty: {
                            message: 'Telp Number is required'
                        }
                    }
                },
            } // end fields
        })
        .on('success.form.fv', function(e) {

            e.preventDefault();

            var $form = $(e.target),
                formData = new FormData(),
                params = $form.serializeArray(),
                files = $form.find('[name="uploadedFiles"]')[0].files;

            $.each(files, function(i, file) {
                // Prefix the name of uploaded files with "uploadedFiles-"
                // Of course, you can change it to any string
                formData.append(i, file);
            });

            $.each(params, function(i, val) {
                formData.append(val.name, val.value);
            });

            l.start();

            $.ajax({
                url: 'function/user/UpdateDataProfile.php',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(result) {
                    // $form.formValidation('resetForm', true);
                    // $('#form-profile')[0].reset(); // reset all fields
                    // $('button').removeAttr('disabled'); // remove atrribute disabled
                    // $('button').removeClass('disabled'); // remove class disabled
                    l.stop();
                    var resultObj = JSON.parse(result);
                    if (resultObj.valid) {
                        $('#form-profile').children().removeClass('has-success'); // remove class has-success
                        $('#form-profile')[0].reset(); // reset all fields
                        loadData(); // load data
                        window.scrollTo(0, 0);
                        $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>Data profile has been updated!</div>");
                        $('#message').fadeIn('slow', function() {
                            $('#message').fadeOut(10000);
                        });
                    }
                }
            });
        });

    // create a new instance for loading
    var a = Ladda.create(document.querySelector('button[name=btn-change-password]'));

    $("#form-change-password").formValidation({
            framework: 'bootstrap',
            fields: {
                password: {
                    validators: {
                        notEmpty: {
                            message: "Password is required"
                        }
                    }
                },
                confirm_password: {
                    validators: {
                        notEmpty: {
                            message: "Confirm password is required"
                        },
                        identical: {
                            field: "password",
                            message: "Confirm Password doesn't match"
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target), // The form instance
                fv = $(e.target).data('formValidation'); // FormValidation instance

            a.start();

            $.ajax({
                url: 'function/auth/UpdatePassword.php',
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                    a.stop();
                    var resultObj = JSON.parse(result);
                    console.log(resultObj);
                    if (resultObj.valid) {
                        $('button').removeAttr('disabled'); // remove atrribute disabled
                        $('button').removeClass('disabled'); // remove class disabled
                        $('#form-change-password')[0].reset(); // reset all fields
                        $('#form-change-password').children().removeClass('has-success'); // remove class has-success
                        window.scrollTo(0, 0);
                        loadData(); // load data
                        $('#message-password').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>Password has been updated!</div>");
                        $('#message-password').fadeIn('slow', function() {
                            $('#message-password').fadeOut(10000);
                        });
                    }
                }
            });
        });
});
