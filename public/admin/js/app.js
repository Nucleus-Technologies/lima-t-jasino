$(function() {

    // Live refresh for notifications nav items
    setInterval(function() {
        $('#nav-item-notif').load(Url["nt_url"], function(response, status, xhr) {
            if (status == "error") {
                $('#nav-item-notif').html('<a href="{{ route(\'admin.notification\') }}" class="nav-link nav-link-icon nav-notification"><i class="fas fa-bell"></i><span class="badge badge-pill badge-secondary"><i class="fas fa-exclamation-triangle"></i></span></a>');
            }
        });
    }, 1000);

    // Textarea Editors
    tinymce.init({
        selector: '.outfit-save-form #input-description'
    });
    tinymce.init({
        selector: '.outfit-save-form #input-specification'
    });

    // Notifications display
    alertDisappear();

    // Dashboard Outfits search
    filterOutfit('#men-outfit-search', '#men-list tr');
    filterOutfit('#women-outfit-search', '#women-list tr');
    filterOutfit('#children-outfit-search', '#children-list tr');

    // Appointment search
    filterOutfit('#done-search', '#done-list tr');
    filterOutfit('#not-done-search', '#not-done-list tr');

    // Relay Points search
    filterOutfit('#relaypoint-search', '#relaypoint-list tr');

    // Orders search
    filterOutfit('#order-search', '#order-list tr');

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