
$(document).ready(function(){

    // get id and code from address
    var productID   = getParameterByName('productID');
    loadData(productID);

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

    // load data from table bank
    function loadData(productID) {

        $.ajax({
            url: 'function/Product/ViewProductDetails.php',
            type: 'POST',
            data: {
                productID: productID
            },
            success: function(result) {
                var resultObj   = JSON.parse(result);
                console.log(resultObj);
                var dataHandler = $('.products');

                $('#loading-svg').hide();

                if (resultObj.empty){
                    var emptyRow = $("<div class='col-lg-8'>");
                    emptyRow.html("<div class='middle-box text-center distance-bottom-more animated fadeInDown'> <h1>404</h1> <h3 class='font-bold'>Page Not Found</h3> <div class='error-desc'> Sorry, but the page you are looking for has note been found. Try checking the URL for error, then hit the refresh button on your browser or try found something else in our app. <form class='form-inline m-t' role='form'> <div class='form-group'> <input type='text' class='form-control' placeholder='Search for page'> </div><button type='submit' class='btn btn-primary'>Search</button> </form> </div></div>");
                    dataHandler.append(emptyRow);
                }else{
                    var description = resultObj.productDescription;
                    var newRow = $("<div class='col-lg-8 col-md-5 distance-top'>");
                    newRow.html("<div class='product-detail'><div class='distance-bottom-more'><div class='row'><div class='col-md-5'><div class='product-images'><div><div class='image-imitation'><img class='center-block' src='uploads/product/"+resultObj.images[0].image_name+"' alt='' /></div></div><div><div class='image-imitation'><img class='center-block' src='uploads/product/"+resultObj.images[1].image_name+"' alt='' /></div></div><div><div class='image-imitation'><img class='center-block' src='uploads/product/"+resultObj.images[2].image_name+"' alt='' /></div></div></div></div><div class='col-md-7'><h2 class='font-bold m-b-xs'>"+resultObj.productName+"</h2><small>Many desktop publishing packages and web page editors now.</small><div class='m-t-md'><h2 class='product-main-price'>IDR "+number_format(resultObj.productPrice)+"</h2></div><hr><h4>Product Description</h4><div class='small description text-muted'>"+resultObj.productDescription+"</div><hr><div><div class='btn-group'><button class='btn btn-primary btn-sm'><i class='fa fa-cart-plus'></i> Add to cart</button><button class='btn btn-white btn-sm'><i class='fa fa-star'></i> Add to wishlist </button><button class='btn btn-white btn-sm'><i class='fa fa-envelope'></i> Contact with author </button></div></div></div></div></div><div class='ibox-footer'><span class='pull-right'>Last Update - <i class='fa fa-clock-o'></i> "+resultObj.update_at+"</span>Available Stock is "+resultObj.productQty+" pcs </div></div>");
                    dataHandler.append(newRow);

                    $('.product-images').slick({
                            dots: true
                        });
                }
            }
        })
    }
});
