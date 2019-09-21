$(function() {

    if ($('.save-order-form #relaypoint').prop('checked')) {
        $('.save-order-form #btn-save-order').removeAttr('disabled');
    } else {
        $('.save-order-form #btn-save-order').attr('disabled', '');
    }

    if ($('.payment-mode-form #cash-on-delivery').prop('checked')) {
        $('.cod').addClass('show');
    } else if ($('.payment-mode-form #orange-money').prop('checked')) {
        $('.om').addClass('show');
    } else if ($('.payment-mode-form #momo').prop('checked')) {
        $('.momo').addClass('show');
    }

    $('.payment-mode-form .radion_btn').on('click', function() {
        $('.radion_text').removeClass('show');
        $(this).children('.radion_text').addClass('show');
    });


    $('.checkout_area #region').on('change', function() {
        load_cities($(this).val(), $('.checkout_area #city'));
    });

    $('.address-item').click(function() {
        $('.choose-address-details-form').submit();
    })

    $('.save-order-form #relaypoint').click(function() {
        if ($(this).prop('checked')) {
            $('.save-order-form #btn-save-order').removeAttr('disabled');
        } else {
            $('.save-order-form #btn-save-order').attr('disabled', '');
        }

        $('#order_inner').fadeOut();
        refresh_order($(this).val());
        $('#order_inner').fadeIn();
    });

});