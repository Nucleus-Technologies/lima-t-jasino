function alertDisappear() {
    setTimeout(function() {
        $('#alert-response .alert').alert('close').fadeOut();
        $('#alert-response').fadeOut();
    }, 10000);
}

function fadeAlert(type, message) {

    var alert = '<div class="alert alert-' + type + ' alert-dismissible alert-floatable fade show" role="alert"> <span class="alert-inner--icon"> <i class="ni ni-bell-55"></i> </span> <span class="alert-inner--text"> <strong>Info!</strong> ' + message + ' </span> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';

    $('#alert-response').fadeIn();

    $('#alert-response').prepend(alert);

    alertDisappear();

}

function filterOutfit(input, tr) {

    $(input).on("keyup", function() {
        var value = $(this).val().toLowerCase();

        $(tr).filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

}