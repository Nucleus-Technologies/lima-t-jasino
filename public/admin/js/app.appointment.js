$(function() {

    // Replying to an appointment
    var id = $('#id').val();

    $('.answer-appointment-form').validate({
        rules: {
            answered_message: {
                required: true
            }
        },

        messages: {
            answered_message: {
                required: "Your answer to this appointment is required."
            }
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btn-appointment-reply').html('<span class="btn-inner--text"> <i class="fas fa-spinner mr-1"></i> SENDING IN PROGRESS... </span>');

            var request = $.ajax({
                type: 'POST',
                url: '/admin/appointment/appointment-' + id + '/reply',
                data: $('.answer-appointment-form').serialize()
            });

            request.done(function(response) {
                $('#btn-appointment-reply').html('<i class="fas fa-reply"></i> REPLY');

                fadeAlert((response.status) ? 'success' : 'danger', response.msg);

                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            });

            request.fail(function() {
                $('#btn-appointment-reply').html('<i class="fas fa-reply"></i> REPLY');

                fadeAlert('danger', "An script error occured while replying to this appointment!");
            });

            $('.answer-appointment-form').trigger('reset');
        }

    });

    // Mark an appointment as done
    $('.mark-done-btn').click(function(e) {
        e.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content'),
            id = $(this).children('#id').val();

        var request = $.ajax({
            type: 'POST',
            url: '/admin/appointment/appointment-' + id + '/done',
            data: '_token=' + _token
        });

        request.done(function(response) {
            fadeAlert((response.status) ? 'success' : 'danger', response.msg);

            setTimeout(function() {
                window.location.reload();
            }, 2000);
        });

        request.fail(function() {
            fadeAlert('danger', "An script error occured while marking this appointment as done!");
        });

    });

});