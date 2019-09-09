$(function() {

    // Add an outfit to the wishlist
    $('.btn-add-to-wishlist').on('click', function(e) {
        e.preventDefault();

        if (!$(this).hasClass('active')) {
            var outfit = $(this).parent().find('input[name=outfit]').val();

            var request = $.ajax({
                type: 'POST',
                url: '/users/wishlist/outfit-' + outfit + '/store',
                data: $(this).parent('form').serialize()
            });

            request.done(function(response) {
                if (response.status) {
                    $(this).addClass('active');

                    fadeAlert((response.status) ? 'success' : 'danger', response.msg);
                } else {
                    fadeAlert('danger', response.msg);
                }
            });

            request.fail(function() {
                fadeAlert('danger', "An script error occured while adding this outfit to your wishlist!");
            });
        }

    });

    // Remove an outfit from the wishlist
    $('.btn-remove-from-wishlist').on('click', function(e) {
        e.preventDefault();

        var wishlist = $(this).parent().find('input[name=wishlist]').val();

        var request = $.ajax({
            type: 'POST',
            url: '/users/wishlist/line-' + wishlist + '/destroy',
            data: $(this).parent('form').serialize()
        });

        request.done(function(response) {
            if (response.status) {
                $('#wishlist_inner').fadeOut();
                refresh_wishlist();
                $('#wishlist_inner').fadeIn();
            } else {
                fadeAlert('danger', response.msg);
            }
        });

        request.fail(function() {
            fadeAlert('danger', "An script error occured while removing this outfit from your cart!");
        });
    });
});