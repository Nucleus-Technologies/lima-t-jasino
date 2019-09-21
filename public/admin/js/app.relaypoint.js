$(function() {

    $('.relaypoint-save-form #region').on('change', function() {
        load_cities($(this).val(), $('.relaypoint-save-form #city'));
    });

    // Saving a relay point
    $('.relaypoint-save-form').validate({
        rules: {
            region: {
                required: true
            },
            city: {
                required: true
            },
            label: {
                required: true
            },
            near: {
                required: true
            },
            address: {
                required: true
            },
            contact: {
                required: true
            },
            opening_hours: {
                required: true
            },
            shipping_cost: {
                required: true,
                min: 0
            }
        },

        messages: {
            region: {
                required: "A region is required for this relay point."
            },
            city: {
                required: "A city is required for this relay point."
            },
            label: {
                required: "A name is required for this relay point."
            },
            near: {
                required: "A nearest point is required for this relay point."
            },
            address: {
                required: "An address is required for this relay point."
            },
            contact: {
                required: "A contact is required for this relay point."
            },
            opening_hours: {
                required: "You must define opening hours for this relay point."
            },
            shipping_cost: {
                required: "You must specify the shipping cost of this relay point.",
                min: "The shipping cost at least XAF 0."
            }
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btn-relaypoint-save').html('<i class="fas fa-spinner mr-1"></i> Saving in progress... </span>');

            var request = $.ajax({
                type: 'POST',
                url: '/admin/relaypoint/store',
                data: $('.relaypoint-save-form').serialize()
            });

            request.done(function(response) {
                $('#btn-relaypoint-save').html('<i class="fas fa-check-circle mr-1"></i> Save the relay point');

                fadeAlert((response.status) ? 'success' : 'danger', response.msg);

                if (response.status) {
                    $('.relaypoint-save-form').trigger('reset');

                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            });

            request.fail(function() {
                $('#btn-relaypoint-save').html('<i class="fas fa-check-circle mr-1"></i> Save the relay point');

                fadeAlert('danger', "An script error occured while saving the relay point!");
            });
        }

    });

});