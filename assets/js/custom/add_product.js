$(document).ready(function(){

  loadCategories('select[name=categories]');
  $('select[name=categories]').on('click', function(e){
    e.preventDefault();
      $('select[name=categories] option:first-child').hide();
  });

  $('select[name=subcategories]').on('click', function(e){
    e.preventDefault();
      $('select[name=subcategories] option:first-child').hide();
  });

  $('select[name=categories]').change(function() {
    $('#subcategories').show();
    $('select[name=subcategories]').val('');
    var idCategory =   $('select[name=categories]').val();
    loadSubCategories(idCategory,'select[name=subcategories]');
  });

  function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i=0; i<ca.length; i++) {
          var c = ca[i];
          while(c.charAt(0)==' ') {
              c = c.substring(1);
          }
          if(c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
          }
      }
      return "";
  }

  /// create a new instance for loading
  var l = Ladda.create( document.querySelector( 'button[name=btn-add-product]' ) );
  $("#form-data-add-product").formValidation({
    framework : 'bootstrap',
    fields : {
      uploadedFiles: {
          validators: {
            file: {
              extension: 'jpeg,jpg,png',
              type: 'image/jpeg,image/png',
              maxSize: 2097152,   // 2048 * 1024
              message: 'The selected file is not valid'
            }
          }
      },
      categories : {
        validators : {
          notEmpty: {
            message: 'Categories is required'
          }
        }
      },
      subcategories : {
        validators : {
          notEmpty: {
            message: 'Sub Categories is required'
          }
        }
      },
      productName : {
        validators : {
          notEmpty: {
            message: 'Product Name is required'
          }
        }
      },
      description : {
        validators : {
          notEmpty: {
              message: 'Description is required'
          },
          stringLength: {
            max: 200,
            message: 'The bio must be less than 200 characters'
          }
        }
      },
      price : {
        validators : {
          notEmpty: {
            message: 'Price is required'
          }
        }
      },
      quantity : {
        validators : {
          notEmpty: {
            message: 'Price is required'
          }
        }
      }
    }
  })
  .on('success.form.fv', function(e) {
    // Prevent form submission
    e.preventDefault();

    var $form    = $(e.target),
        formData = new FormData(),
        params   = $form.serializeArray(),
        files    = $form.find('[name="uploadedFiles"]')[0].files;

    $.each(files, function(i, file) {
        // Prefix the name of uploaded files with "uploadedFiles-"
        // Of course, you can change it to any string
        formData.append(i, file);
    });

    $.each(params, function(i, val) {
        formData.append(val.name, val.value);
    });

    // start loading animation
    l.start();

    $.ajax({
      url: 'function/product/upload.php',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(result){
        console.log(result);
        l.stop();
        var resultObj = JSON.parse(result);
        console.log(resultObj);
        $form.formValidation('resetForm', true);
        $('#form-data-add-product')[0].reset(); // reset all fields
        $('form-data-add-product').children().removeClass('has-success'); // remove class has-success
        $('button').removeAttr('disabled'); // remove atrribute disabled
        $('button').removeClass('disabled'); // remove class disabled
        $('html,body').animate({
            scrollTop: 0
        }, 700);

        if(resultObj.valid){
            $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>"+resultObj.valid+"</div>");
            $('#message').fadeIn('slow', function(){
              $('#message').fadeOut(7000);
            });
        } else if(resultObj.error) {
            $('#message').html("<div class='alert alert-danger alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>"+resultObj.error+"</div>");
            $('#message').fadeIn('slow', function(){
              $('#message').fadeOut(7000);
            });
        }
      } // end success
    })
    .fail(function() {
      console.log("error");
    });
  });

  function loadCategories(id){
    $('#subcategories').hide();
    $.ajax({
      url: 'function/product/Load.php',
      type: 'POST',
      data: {type: 'LoadCategories'},
      success: function(response){
        console.log(response);
        resultObj = JSON.parse(response);
        $(id).html('<option value="">Select</option>');
        subcategories = '';
        $.each(resultObj, function(key, val) {
        console.log(resultObj);
          subcategories = '<option value="'+val.categoriesID+'">'+val.categoryName+'</option>'
          $(id).append(subcategories);
        });
      }
    })
    .fail(function() {
      console.log("error");
    });
  }

  function loadSubCategories(sub,id){

    $.ajax({
      url: 'function/product/Load.php',
      type: 'POST',
      data: {categoriesID: sub, type: 'LoadSubCategories'},
      success: function(response){
        console.log(response);
        resultObj = JSON.parse(response);
        $(id).html('<option value="">Select</option>');
        subcategories = '';
        $.each(resultObj, function(key, val) {
        console.log(resultObj);
          subcategories = '<option value="'+val.subcategoriesID+'">'+val.subName+'</option>'
          $(id).append(subcategories);
        });
      }
    })
    .fail(function() {
      console.log("error");
    });
  }

});
