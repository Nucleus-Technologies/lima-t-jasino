$(function() {

    alertDisappear();

    // Dashboard Outfits search
    filterOutfit('#men-outfit-search', '#men-list tr');
    filterOutfit('#women-outfit-search', '#women-list tr');
    filterOutfit('#children-outfit-search', '#children-list tr');

    // Appointment search
    filterOutfit('#done-search', '#done-list tr');
    filterOutfit('#not-done-search', '#not-done-list tr');

    $('.admin-data-form').validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 8
            }
        },

        messages: {
            username: {
                required: "The username field is required."
            },
            password: {
                required: "The password field is required.",
                minlength: "The password should be at least 8 caracters."
            }
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btn-admin-edit').html('<span class="btn-inner--text"> <i class="fas fa-spinner mr-1"></i> Profile Editing... </span>');

            var request = $.ajax({
                type: 'POST',
                url: '/admin/profile',
                data: $('.admin-data-form').serialize()
            });

            request.done(function(response) {
                $('#btn-admin-edit').html('<span class="btn-inner--text"> <i class="fas fa-edit mr-1"></i> Edit Profile </span>');

                fadeAlert((response.status) ? 'success' : 'danger', response.msg);
            });

            $('.admin-data-form').trigger('reset');
        }

    });

});