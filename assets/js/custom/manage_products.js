$(document).ready(function() {
  loadData();


  $("#form-data-add textarea[name=description]").markdown({autofocus:false,savable:false});
  $("#form-data-update textarea[name=description]").markdown({autofocus:false,savable:false,initialstate: 'preview'});

  // data table pagination
  $('.table').footable({
		"paging": {
			"enabled": true
		}
	});


  // pagination click
  $('.pagination').on('click', function(event) {
    event.preventDefault();
    /* Act on the event */

    $('html,body').animate({
        scrollTop: 0
    }, 700);
  });

  // cancel button form add
  $('#form-data-add #cancel-btn-add').on('click', function(e) {
      e.preventDefault();
      $('#modal-form-add').modal('hide');
  });

  // cancel button form add
  $('#form-data-update #cancel-btn-update').on('click', function(e) {
      e.preventDefault();
      $('#modal-form-update').modal('hide');
  });

  $('input[name=price]').keyup(function(event) {
		 $(this).val(number_format($(this).val()));
	});

  // hide form data global
  $('#form-data-add #subcategories').hide();
  $('#form-data-add #productID').hide();
  $('#form-data-update #productID').hide();
  $('#form-data-update #subcategories').hide();

  // event on click global
  $('select[name=categories]').on('click', function(e){
    e.preventDefault();
      $('select[name=categories] option:first-child').hide();
  });
  $('select[name=subcategories]').on('click', function(e){
    e.preventDefault();
      $('select[name=subcategories] option:first-child').hide();
  });

  // event change form data add
  $('#form-data-add select[name=categories]').change(function()
  {
    $('#form-data-add #subcategories').show();
    $('#form-data-add select[name=subcategories]').val('');
    var idCategory =   $('#form-data-add select[name=categories]').val();
    loadSubCategories(idCategory,'#form-data-add select[name=subcategories]');
  });

  // load categories form data add
    loadCategories('#form-data-add select[name=categories]');

  // event change form data update product
  $('#form-data-update select[name=categories]').change(function()
  {
    $('#form-data-update #subcategories').show();
    $('#form-data-update select[name=subcategories]').val('');
    var idCategory =   $('#form-data-update select[name=categories]').val();
    loadSubCategories(idCategory,'#form-data-update select[name=subcategories]');
  });

  // get data cookie
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

  // load data product from database
  function loadData(){
      var dataID = getCookie('id');
      console.log(dataID);

      $.ajax({
      url         : 'function/product/Load.php',
      type        : 'POST',
      data        : {sellerID: dataID, type : 'LoadDataProducts'},
      success     : function(result){
              console.log(result);
              var resultObj = JSON.parse(result);
              var number = 0;
              var dataHandler = $('#table-products');
              dataHandler.html("");

              if(resultObj.empty){
                  var emptyRow = $("<tr>");
                  emptyRow.html("<td colspan='8' style=' height:100px; padding-top:50px; text-align:center;'>Your product is empty</td>");
                  dataHandler.append(emptyRow);
              }else{
                  $.each(resultObj, function(key, val) { // looping data
                      number++;
                      var newRow = $("<tr>");
                      newRow.html("<td>"+number+"</td><td>"+val.categoryName+"</td><td><img src='uploads/product/"+val.image_name+"' alt='' width='160' height='100' /></td><td>"+val.productName+"</td><td>"+number_format(val.productPrice)+"</td><td>"+val.productQty+"</td><td>"+val.productWeight+"</td><td><a class='preview' href='product_details.php?productID="+val.productID+"'><i title='Preview' class='fa fa-eye'></i></a></td><td><a href='#modal-form-update' data-toggle='modal' id='"+val.productID+"' class='edit_product'><i title='Edit' class='fa fa-pencil'></i></a></td><td><a class='delete_product' id='"+val.productID+"' href='javascript:void(0)'><i title='Delete' class='fa fa-trash'></i></a></td>");
                      dataHandler.append(newRow).trigger('footable_redraw');
                  })
              }
          }
      });
  }

  // create a new instance for loading
  var a = Ladda.create( document.querySelector( 'button[name=submit-btn-add]') );
  // form validation update product
  $('#form-data-add').formValidation({
    framework: 'bootstrap',
      fields: {
          categories: {
              validators: {
                  notEmpty: {
                      message: 'Categories is required'
                  }
              }
          },
          subcategories: {
              validators:{
                  notEmpty: {
                          message: 'Subcategories is required'
                  }
              }
          },
          productName: {
              validators: {
                  notEmpty: {
                      message: 'Product Name is required'
                  }
              }
          },
          description: {
              validators: {
                  notEmpty: {
                      message: 'Description is required'
                  }
              }
          },
          price: {
              validators: {
                  notEmpty: {
                      message: 'Price is required'
                  }
              }
          },
          weight: {
              validators: {
                  notEmpty: {
                      message: 'Weight is required'
                  }
              }
          },
          quantity: {
              validators: {
                  notEmpty: {
                      message: 'Quantiy is required'
                  }
              }
          }
      } // fields
  }) // form validation
  .on('success.form.fv', function(e) {
    e.preventDefault(); // prevent form submission

    a.start();

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

    $.ajax({
      url: 'function/product/AddDataProduct.php',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(result){
        console.log(result);
        a.stop();
        var resultObj = JSON.parse(result);
        // console.log(resultObj);
        $form.formValidation('resetForm', true);
        $('#modal-form-add').modal('hide');
        $('#form-data-add')[0].reset(); // reset all fields
        $('#form-data-add').children().removeClass('has-success'); // remove class has-success
        $('button').removeAttr('disabled'); // remove atrribute disabled
        $('button').removeClass('disabled'); // remove class disabled
        $('html,body').animate({
            scrollTop: 0
        }, 700);
        loadData();

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
  });


  // edit product show when clicked
  $(document).on('click', '.edit_product', function(e){
      e.preventDefault();

      var dataID = $(this).attr('id'); // get data from attribute id

      $.ajax({
          url     : 'function/product/EditDataProduct.php',
          type    : 'POST',
          data    : {productID : dataID},
          success : function(result){
              var resultObj = JSON.parse(result);
              console.log(resultObj);

              // replace data that loaded to form
              findCategories(resultObj.subcategoriesID);
              $('#form-data-update input[name=productID]').val(resultObj.productID);
              $('#form-data-update input[name=productName]').val(resultObj.productName);
              $('#form-data-update textarea[name=description]').val(resultObj.productDescription);
              $('#form-data-update input[name=price]').val(number_format(resultObj.productPrice));
              $('#form-data-update input[name=weight]').val(resultObj.productWeight);
              $('#form-data-update input[name=quantity]').val(resultObj.productQty);
              $('#form-data-update #categories').show();
              $('#form-data-update #subcategories').show();
          }
      })
  });

  // create a new instance for loading
  var u = Ladda.create( document.querySelector( 'button[name=submit-btn-update]') );
  // form validation update product
  $('#form-data-update').formValidation({
    framework: 'bootstrap',
      fields: {
          categories: {
              validators: {
                  notEmpty: {
                      message: 'Categories is required'
                  }
              }
          },
          subcategories: {
              validators:{
                  notEmpty: {
                          message: 'Subcategories is required'
                  }
              }
          },
          productName: {
              validators: {
                  notEmpty: {
                      message: 'Product Name is required'
                  }
              }
          },
          description: {
              validators: {
                  notEmpty: {
                      message: 'Description is required'
                  }
              }
          },
          price: {
              validators: {
                  notEmpty: {
                      message: 'Price is required'
                  }
              }
          },
          weight: {
              validators: {
                  notEmpty: {
                      message: 'Weight is required'
                  }
              }
          },
          quantity: {
              validators: {
                  notEmpty: {
                      message: 'Quantiy is required'
                  }
              }
          }
      } // fields
  }) // form validation
  .on('success.form.fv', function(e) {
    e.preventDefault(); // prevent form submission

    u.start();

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

    $.ajax({
      url: 'function/product/UpdateDataProduct.php',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(result){
        console.log(result);
        u.stop();
        var resultObj = JSON.parse(result);
        // console.log(resultObj);
        $form.formValidation('resetForm', true);
        $('#modal-form-update').modal('hide');
        $('#form-data-update')[0].reset(); // reset all fields
        $('#form-data-update').children().removeClass('has-success'); // remove class has-success
        $('button').removeAttr('disabled'); // remove atrribute disabled
        $('button').removeClass('disabled'); // remove class disabled
        $('html,body').animate({
            scrollTop: 0
        }, 700);
        loadData();

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
  });


  // delete data product
  $(document).on('click', '.delete_product',function(e)
  {
      e.preventDefault(); /* prevent link address */
      var dataID = $(this).attr('id'); /* get data id */

      $("#confirm").html("Are you sure want to delete?"); /* pop up modals confirmation */
      $('#modal-form-delete').modal('show');
      $('#cancel').click(function() {

          $('#modal-form-delete').modal('hide');
      });

      $('#sure').on('click',function(e)
      {
         e.preventDefault();

          $.ajax({
              url     : 'function/product/DeleteDataProduct.php',
              type    : 'POST',
              data    : {productID : dataID},
              success : function(result){
                  var resultObj = JSON.parse(result);
                  console.log(result);
                  $('#modal-form-delete').modal('hide'); // hide modal form add
                  $('html,body').animate({
                      scrollTop: 0
                  }, 700);
                  loadData();
                  if (resultObj.valid) {
                        $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>"+resultObj.valid+"</div>");
                        $('#message').fadeIn('slow', function(){
                          $('#message').fadeOut(7000);
                        });

                  }
              }
          }); // end ajax
      }); // end sure
  }); // end delete

  // load categories
  function loadCategories(id, loadData = '')
  {
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
          if(loadData == val.categoriesID){
            subcategories = '<option selected value="'+val.categoriesID+'">'+val.categoryName+'</option>'
          }else {
            subcategories = '<option value="'+val.categoriesID+'">'+val.categoryName+'</option>'
          }
          $(id).append(subcategories);
        });
      }
    })
    .fail(function() {
      console.log("error");
    });
  }

  // load sub categories
  function loadSubCategories(sub,id,loadData ='')
  {
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
          if (val.subcategoriesID == loadData) {
              subcategories = '<option value="'+val.subcategoriesID+'" selected>'+val.subName+'</option>'
          } else {
              subcategories = '<option value="'+val.subcategoriesID+'">'+val.subName+'</option>'
          }
          $(id).append(subcategories);
        });
      }
    })
    .fail(function() {
      console.log("error");
    });
  }

  // to help to find categories ID
  function findCategories(data)
  {
    $.ajax({
      url: 'function/product/FindCategoriesID.php',
      type: 'POST',
      data: {subcategoriesID: data},
      success: function(result){
        var resultObj = JSON.parse(result);
        loadCategories('#form-data-update select[name=categories]',resultObj.categoriesID);
        loadSubCategories(resultObj.categoriesID,'#form-data-update select[name=subcategories]',resultObj.subcategoriesID);
      }
    });
  }

  // format number
  function number_format(user_input){
    var filtered_number = user_input.replace(/[^0-9]/gi, '');
    var length = filtered_number.length;
    var breakpoint = 1;
    var formated_number = '';

    for(i = 1; i <= length; i++){
        if(breakpoint > 3){
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
