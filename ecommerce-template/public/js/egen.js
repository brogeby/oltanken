
    $('.update-cart-form input[name=quantity').on('change', function(){
        $(this).parent().submit();
    });