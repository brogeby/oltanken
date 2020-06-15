
    $('.update-cart-form input[name=quantity').on('change', function(){
        $(this).parent().submit();
    });
    // $(".itemQty").on('change', function(){
    //     var $el = $(this).closest('tr');
    //     var pid = $el.find(".pid").val();
    //     var pprice = $el.find(".pprice").val();
    //     var qty = $el.find(".itemQty").val();
    //     console.log(qty);
    //     $.ajax({
    //         url: 'checkout.php',
    //         method: 'post',
    //         cache: false,
    //         data: {
    //             qty: qty,
    //             pid: pid,
    //             pprice: pprice
    //         },
    //         success: function(response){
                
    //             console.log(response);
    //         }
    //     });
    //   });