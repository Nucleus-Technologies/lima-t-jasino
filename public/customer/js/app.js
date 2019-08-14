$(function() {

    // Live refresh for notifications nav items
    setInterval(function() {
        $('#nav-item-notif').load(notifUrl, function(response, status, xhr) {
            if (status == "error") {
                var msg = "Sorry but there was an error: ";
                $("#nav-item-notif").html(msg + xhr.status + " " + xhr.statusText);
            }
        });
    }, 1000);

});