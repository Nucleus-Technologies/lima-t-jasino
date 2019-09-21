$(function() {

    $('#accordionRegionsCities').on('hidden.bs.collapse', function() {
        $(this).find('button[aria-expanded=false]').html('<i class="fas fa-plus"></i>')
    })

    $('#accordionRegionsCities').on('shown.bs.collapse', function() {
        $(this).find('button[aria-expanded=true]').html('<i class="fas fa-minus"></i>')
    })

    $('.region-city-record-form input[name=label_r]').on('focus', function() {
        $('.region-city-record-form select[name=region]').val('');
    });

    $('.region-city-record-form select[name=region]').on('change', function() {
        $('.region-city-record-form input[name=label_r]').val('');
    });

    $('#modal-region-city-form').on('hide.bs.modal', function() {
        window.location.reload();
    });

    // Recording a region/city
    $('.region-city-record-form').validate({
        rules: {
            label_c: {
                required: true
            }
        },

        messages: {
            label_c: {
                required: "A valid name is required for this city."
            }
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btn-region-city-record').html('<i class="fas fa-spinner mr-1"></i> Recording in progress... </span>');

            var request = $.ajax({
                type: 'POST',
                url: '/admin/region_city/store',
                data: $('.region-city-record-form').serialize()
            });

            request.done(function(response) {
                $('#btn-region-city-record').html('<i class="fas fa-check-circle mr-1"></i> Record the region/city');

                fadeAlert((response.status) ? 'success' : 'danger', response.msg);

                if (response.status) {
                    load_regions($('.region-city-record-form #region'));
                    $('.region-city-record-form').trigger('reset');
                }
            });

            request.fail(function() {
                $('#btn-region-city-record').html('<i class="fas fa-check-circle mr-1"></i> Record the region/city');

                fadeAlert('danger', "An script error occured while recording the region/city!");
            });
        }

    });

});