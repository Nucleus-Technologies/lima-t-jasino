// Helpers

function alertDisappear() {
    setTimeout(function() {
        $('#alert-response .alert').alert('close').fadeOut();
        $('#alert-response').fadeOut();
    }, 2000);
}

function fadeAlert(type, message) {
    var alert = '<div class="alert alert-' + type + ' alert-dismissible alert-floatable fade show" role="alert"> <span class="alert-inner--icon"> <i class="ni ni-bell-55"></i> </span> <span class="alert-inner--text"> <strong>Info!</strong> ' + message + ' </span> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';

    $('#alert-response').fadeIn();
    $('#alert-response').prepend(alert);

    alertDisappear();
}

function op_qty(elt) {
    $quantity = elt.parent().find('input[name=quantity]');
    var quantity = parseInt($quantity.val());

    if (elt.hasClass('increase')) {
        if (!isNaN(quantity)) {
            quantity++;
            $quantity.val(quantity);
        }
    } else if (elt.hasClass('reduced')) {
        if (!isNaN(quantity) && quantity > 1) {
            quantity--;
            $quantity.val(quantity);
        }
    }
}

function update_quantity(elt) {

    $quantity = elt.parent().find('input[name=quantity]');
    var quantity = parseInt($quantity.val());

    var cart = elt.parent().find('input[name=cart]').val();

    var request = $.ajax({
        type: 'PUT',
        url: '/users/cart/line-' + cart + '/quantity/update',
        data: elt.parent('form').serialize()
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
        fadeAlert('danger', "An script error occured while updating this outfit quantity!");
    });
}

// Refresh Icon Cart
function refresh_icon_cart() {
    $('#nav-item-cart').load(Url["cartIconRefreshUrl"], function(response, status, xhr) {
        if (status == "error") {
            var msg = "Sorry but there was an error: ";
            $("#nav-item-cart").html(msg + xhr.status + " " + xhr.statusText);
        }
    });
}

// Refresh Cart
function refresh_cart() {
    $('#cart_inner').load(Url["cartRefreshUrl"], function(response, status, xhr) {
        $.getScript(Url["cartScriptUrl"]);
        $.getScript(Url["outfitScriptUrl"]);
        $.getScript(Url["wishlistScriptUrl"]);

        if (status == "error") {
            var msg = "Sorry but there was an error: ";
            $("#cart_inner").html(msg + xhr.status + " " + xhr.statusText);
        }
    });
}

// Refresh Wishlist
function refresh_wishlist() {
    $('#wishlist_inner').load(Url["wishlistRefreshUrl"], function(response, status, xhr) {
        $.getScript(Url["wishlistScriptUrl"]);
        $.getScript(Url["outfitScriptUrl"]);
        $.getScript(Url["cartScriptUrl"]);

        if (status == "error") {
            var msg = "Sorry but there was an error: ";
            $("#wishlist_inner").html(msg + xhr.status + " " + xhr.statusText);
        }
    });
}


//
// Pages and Events
//


// Mark a notification as read
$('.list-notification .list-group-item').click(function(e) {
    e.preventDefault();

    $(this).find('.notif-form').submit();
});

// Increase and reduced an outfit quantity on cart and view
$('.increase').click(function() {
    op_qty($(this));
    if ($(this).parent('form.line-cart').length) {
        update_quantity($(this));
    }
});

$('.reduced').click(function() {
    op_qty($(this));
    if ($(this).parent('form.line-cart').length) {
        update_quantity($(this));
    }
});

$('#sst').on('blur', function() {
    if ($(this).parent('form.line-cart').length) {
        update_quantity($(this));
    }
});