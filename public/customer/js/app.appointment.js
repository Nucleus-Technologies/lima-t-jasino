$(function() {

    var today = new Date(),
        dd = String(today.getDate()).padStart(2, '0'),
        mm = String(today.getMonth() + 1).padStart(2, '0'),
        yyyy = today.getFullYear(),
        open_time = '08:00',
        close_time = '20:00';

    today = yyyy + '-' + mm + '-' + dd;

    // Booking appointment
    $('.book-appointment-form').validate({
        rules: {
            location: {
                required: true
            },
            takes_place_the: {
                required: true,
                date: true,
                min: today
            },
            starts_at: {
                required: true,
                min: open_time,
                max: close_time
            },
            ends_at: {
                required: true,
                min: $(".starts_at").val(),
                max: close_time
            },
            specified_message: {
                required: true
            }
        },

        messages: {
            location: {
                required: "You must select a location for this appointment."
            },
            takes_place_the: {
                required: "You must choose the day of the appointment.",
                date: "This field must be a date.",
                min: "This appointment' date must be at least today."
            },
            starts_at: {
                required: "You must choose at what time you want the appointment to start.",
                min: "This appointment must starts at least at " + open_time + ".",
                max: "This appointment must starts no later than " + close_time + "."
            },
            ends_at: {
                required: "You must choose at what time you want the appointment to end.",
                min: "This time is less than the starting time.",
                max: "This appointment must starts no later than " + close_time + "."
            },
            specified_message: {
                required: "It's very important that you specifies a message to our tailors."
            }
        },

        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btn-book-appointment').html('<i class="fas fa-spinner mr-1"></i> Booking in progress...');

            var request = $.ajax({
                type: 'POST',
                url: '/users/appointment/store',
                data: $('.book-appointment-form').serialize()
            });

            request.done(function(response) {
                $('#btn-book-appointment').html('Book this appointment');

                fadeAlert((response.status) ? 'success' : 'danger', response.msg);

                if (response.status) {
                    $('.book-appointment-form').trigger('reset');
                }
            });

            request.fail(function() {
                $('#btn-book-appointment').html('Book this appointment');

                fadeAlert('danger', "An script error occured while booking your appointment!");
            });
        }
    });

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
                url: '/users/appointment/appointment-' + id + '/reply',
                data: $('.answer-appointment-form').serialize()
            });

            request.done(function(response) {
                $('#btn-appointment-reply').html('<i class="fas fa-reply"></i> REPLY');

                fadeAlert((response.status) ? 'success' : 'danger', response.msg);

                if (response.status) {
                    $('.answer-appointment-form').trigger('reset');

                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            });

            request.fail(function() {
                $('#btn-appointment-reply').html('<i class="fas fa-reply"></i> REPLY');

                fadeAlert('danger', "An script error occured while replying to the tailors!");
            });
        }

    });

});