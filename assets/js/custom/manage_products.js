$(document).ready(function() {
  loadData();

  $('.table').footable({
		"paging": {
			"enabled": true
		}
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

  // load data from table bank
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
                      newRow.html("<td>"+number+"</td><td>"+val.categoryName+"</td><td><img src='uploads/product/"+val.image_name+"' alt='' width='160' height='100' /></td><td>"+val.productName+"</td><td>"+number_format(val.productPrice)+"</td><td>"+val.productQty+"</td><td>"+val.productWeight+"</td><td><a data-toggle='modal' class='edit_bank' id='"+val.productID+"' href='#modal-form-update'><i title='Edit' class='fa fa-pencil'></i></a></td><td><a class='delete_bank' id='"+val.productID+"' href='javascript:void(0)'><i title='Delete' class='fa fa-trash'></i></a></td>");
                      dataHandler.append(newRow).trigger('footable_redraw');
                  })
              }
          }
      });
  }

  // /// create a new instance for loading
  // var l = Ladda.create( document.querySelector( 'button[name=btn-add]' ) );
  // // Form Validation add
  // $('#form-data-add').formValidation({
  //   framework: 'bootstrap',
  //       fields: {
  //           bankID: {
  //               validators: {
  //                   notEmpty: {
  //                       message: 'Bank is required'
  //                   }
  //               }
  //           },
  //           accountNumber: {
  //               validators:{
  //                   notEmpty: {
  //                           message: 'Account Number is required'
  //                   },
  //                   integer: {
  //                       message: "Account Number isn't valid"
  //                   }
  //               }
  //           },
  //           ownerName: {
  //               validators: {
  //                   notEmpty: {
  //                       message: 'Owner Name is required'
  //                   }
  //               }
  //           },
  //           branch: {
  //               validators: {
  //                   notEmpty: {
  //                       message: 'Branch is required'
  //                   }
  //               }
  //           }
  //       } // end fields
  //   }) // end form validation
  //   .on('success.form.fv', function(e) {
  //   // Prevent form submission
  //   e.preventDefault();
  //
  //   // Some instances you can use are
  //   var $form = $(e.target),        // The form instance
  //       fv    = $(e.target).data('formValidation'); // FormValidation instance
  //
  //   // start loading animation
  //   l.start();
  //
  //   $.ajax({
  //       url     : 'function/bank/InsertDataBank.php',
  //       type    : 'POST',
  //       data    : $form.serialize(),
  //       success : function(result){
  //           console.log(result);
  //           var resultObj = JSON.parse(result);
  //           console.log(resultObj);
  //
  //           l.stop();
  //           $form.formValidation('resetForm', true);
  //           $('#form-data-add')[0].reset(); // reset all fields
  //           $('#form-data-add').children().removeClass('has-success'); // remove class has-success
  //           $('button').removeAttr('disabled'); // remove atrribute disabled
  //           $('button').removeClass('disabled'); // remove class disabled
  //           loadData(); // load data
  //           $('#modal-form-add').modal('hide'); // hide modal form add
  //
  //           if(resultObj.valid){
  //               $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>"+resultObj.valid+"</div>");
	// 							$('#message').fadeIn('slow', function(){
	// 								$('#message').fadeOut(7000);
	// 							});
  //           } else if(resultObj.error) {
  //               $('#message').html("<div class='alert alert-danger alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>"+resultObj.error+"</div>");
	// 							$('#message').fadeIn('slow', function(){
	// 								$('#message').fadeOut(7000);
	// 							});
  //           }
  //       } // end success
  //   }); // end ajax
  // });
  //
  // // cancel button form add
  // $('#cancel-btn-add').on('click', function(e) {
  //     e.preventDefault();
  //     $('#modal-form-add').modal('hide');
  // });
  //
  // // hide the first option select
  // $("#bankID").on('click', function(e){
  //     e.preventDefault();
  //     $("select option:first-child").hide();
  // });
  //
  // // hide the first option select
  // $("#UbankID").on('click', function(e){
  //     e.preventDefault();
  //     $("select option:first-child").hide();
  // });
  //
  //
  // // edit bank show when click action edit
  // $(document).on('click', '.edit_bank', function(e){
  //     e.preventDefault();
  //
  //     var dataID = $(this).attr('id'); // get data from attribute id
  //
  //     $.ajax({
  //         url     : 'function/bank/getDataBankUpdate.php',
  //         type    : 'POST',
  //         data    : 'seller_bankID='+dataID,
  //         success : function(result){
  //             var resultObj = JSON.parse(result);
  //             console.log(resultObj);
  //
  //             // replace data that loaded to form
  //             $('input[name=Useller_bankID]').val(resultObj.seller_bankID);
  //             $('input[name=UsellerID]').val(resultObj.sellerID);
  //             $('select[name=UbankID]').val(resultObj.bankID);
  //             $('input[name=UaccountNumber]').val(resultObj.accountNumber);
  //             $('input[name=UownerName]').val(resultObj.ownerName);
  //             $('input[name=Ubranch]').val(resultObj.branch);
  //         }
  //     })
  // });

  // // create a new instance for loading
  // var u = Ladda.create( document.querySelector( 'button[name=btn-update]') );
  // // form validation update
  // $('#form-data-update').formValidation({
  //   framework: 'bootstrap',
  //     fields: {
  //         UbankID: {
  //             validators: {
  //                 notEmpty: {
  //                     message: 'Bank is required'
  //                 }
  //             }
  //         },
  //         UaccountNumber: {
  //             validators:{
  //                 notEmpty: {
  //                         message: 'Account Number is required'
  //                 },
  //                 integer: {
  //                     message: "Account Number is'nt valid"
  //                 }
  //             }
  //         },
  //         UownerName: {
  //             validators: {
  //                 notEmpty: {
  //                     message: 'Owner Name is required'
  //                 }
  //             }
  //         },
  //         Ubranch: {
  //             validators: {
  //                 notEmpty: {
  //                     message: 'Branch is required'
  //                 }
  //             }
  //         }
  //     } // fields
  // }) // form validation
  // .on('success.form.fv', function(e) {
  //   e.preventDefault(); // prevent form submission
  //
  //   u.start();
  //
  //   var $form = $(e.target),    // The form instance
  //   fv    = $(e.target).data('formValidation'); // FormValidation instance
  //
  //   $.ajax({
  //       url     : 'function/bank/updateDataBank.php',
  //       type    : 'POST',
  //       data    : $form.serialize(),
  //       success : function(result){
  //
  //           var resultObj = JSON.parse(result);
  //           console.log(resultObj);
  //           u.stop();
  //           $form.formValidation('resetForm', true);
  //           $('#form-data-update')[0].reset(); // reset all fields
  //           $('#form-data-update').children().removeClass('has-success'); // remove class has-success
  //           $('button').removeAttr('disabled'); // remove atrribute disabled
  //           $('button').removeClass('disabled'); // remove class disabled
  //           loadData(); // load data
  //           $('#modal-form-update').modal('hide'); // hide modal form add
  //
  //           if (resultObj.valid) {
  //               $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>"+resultObj.valid+"</div>");
	// 							$('#message').fadeIn('slow', function(){
	// 								$('#message').fadeOut(7000);
	// 							});
  //           }
  //       } // end success
  //   }); // end ajax
  // });

  // delete data bank
  $(document).on('click', '.delete_bank',function(e){
      e.preventDefault(); /* prevent link address */
      var dataID = $(this).attr('id'); /* get data id */

      $("#confirm").html("Are you sure want to delete?"); /* pop up modals confirmation */
      $('#modal-form-delete').modal('show');
      $('#cancel').click(function() {

          $('#modal-form-delete').modal('hide');
      });

      $('#sure').on('click',function(e) {
         e.preventDefault();

          $.ajax({
              url     : 'function/bank/deleteDataBank.php',
              type    : 'POST',
              data    : 'seller_bankID='+dataID,
              success : function(result){
                  var resultObj = JSON.parse(result);
                  console.log(result);
                  $('#modal-form-delete').modal('hide'); // hide modal form add
                  if (resultObj.valid) {
                        $('#message').html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>"+resultObj.valid+"</div>");
                        $('#message').fadeIn('slow', function(){
                          $('#message').fadeOut(7000);
                        });
                        loadData();
                  }
              }
          }); // end ajax
      }); // end sure
  }); // end delete

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