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


//
// Pages and Events
//


// Mark a notification as read
$('.list-notification .list-group-item').click(function(e) {
    e.preventDefault();

    $(this).children('.notif-form').submit();
});