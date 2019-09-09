$(function() {

    $('#cart-toast').on('hidden.bs.toast', function() {
        $('#alert-response .toast-floatable').addClass('hide');
        $('#alert-response').hide();
    });

    // Add an outfit to the cart
    $('.btn-add-to-cart').on('click', function(e) {
        e.preventDefault();

        var outfit = $(this).parent().find('input[name=outfit]').val(),
            quantity = $(this).parent().find('input[name=quantity]').val();

        if (parseInt(quantity) === 0) {
            fadeAlert('warning', 'This outfit quantity must be at least 1!!!');
        } else {
            var request = $.ajax({
                type: 'POST',
                url: '/users/cart/outfit-' + outfit + '/store',
                data: $(this).parent('form').serialize()
            });

            request.done(function(response) {
                if (response.status) {
                    refresh_icon_cart();

                    $('#alert-response').fadeIn();
                    $('#alert-response .toast-floatable').removeClass('hide');
                    $('#cart-toast').toast('show');
                } else {
                    fadeAlert('danger', response.msg);
                }
            });

            request.fail(function() {
                fadeAlert('danger', "An script error occured while adding this outfit to your cart!");
            });
        }

    });

    // Remove an outfit from the cart
    $('.btn-remove-from-cart').on('click', function(e) {
        e.preventDefault();

        var line = $(this).parent().find('input[name=line]').val();

        var request = $.ajax({
            type: 'POST',
            url: '/users/cart/line-' + line + '/destroy',
            data: $(this).parent('form').serialize()
        });

        request.done(function(response) {
            if (response.status) {
                refresh_icon_cart();

                $('#cart_inner').fadeOut();
                refresh_cart();
                $('#cart_inner').fadeIn();
            } else {
                fadeAlert('danger', response.msg);
            }
        });

        request.fail(function() {
            fadeAlert('danger', "An script error occured while removing this outfit from your cart!");
        });
    });
});