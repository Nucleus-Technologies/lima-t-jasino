$(function() {

    ScrollReveal().reveal('.collection-area .collection-group .description', {
        origin: 'left',
        scale: 0.7,
        duration: 800
    });
    ScrollReveal().reveal('.collection-area .collection-group .picture', {
        delay: 800,
        origin: 'right',
        scale: 0.7,
        duration: 800
    });

    var $grid = $('.collection-group-area .grid').imagesLoaded(function() {
        // init Masonry after all images have loaded
        $grid.masonry({
            // options...
            itemSelector: '.grid-item',
            transitionDuration: '1s',
            stagger: 40,
        });
    });
    $grid.on('click', '.grid-item', function() {
        $(this).toggleClass('col-lg-12');
        // trigger layout after item size changes
        $grid.masonry();
    });

    // Live refresh for notifications nav items
    setInterval(function() {
        $('#nav-item-notif').load(Url["nt_url"], function(response, status, xhr) {
            if (status == "error") {
                $("#nav-item-notif").html('<a href="{{ route(\'notification\') }}" class="icons nav-notification"><i class="fas fa-bell" aria-hidden="true"></i><span class="badge badge-pill badge-secondary"><i class="fas fa-exclamation-triangle"></i></span></a>');
            }
        });
    }, 1000);

    // Show - Hide search form
    $('#search-link').click(function(e) {
        e.preventDefault();

        $('.nav-search').addClass('show');
    });

    $('.nav-search .close').click(function() {
        $('.nav-search').removeClass('show');
    });

    // Price Range
    $('#price-range-submit').hide();

    $("#min_price, #max_price").on('change', function() {
        $('#price-range-submit').show();

        var min_price_range = parseInt($("#min_price").val());

        var max_price_range = parseInt($("#max_price").val());

        if (min_price_range > max_price_range) {
            $('#max_price').val(min_price_range);
        }

        $("#slider-range").slider({
            values: [min_price_range, max_price_range]
        });
    });

    $("#min_price, #max_price").on("paste keyup", function() {
        $('#price-range-submit').show();

        var min_price_range = parseInt($("#min_price").val());

        var max_price_range = parseInt($("#max_price").val());

        if (min_price_range == max_price_range) {

            max_price_range = min_price_range + 100;

            $("#min_price").val(min_price_range);
            $("#max_price").val(max_price_range);
        }

        $("#slider-range").slider({
            values: [min_price_range, max_price_range]
        });
    });

    $("#slider-range").slider({
        range: true,
        orientation: "horizontal",
        min: 0,
        max: 100000,
        values: [0, 100000],
        step: 100,

        slide: function(event, ui) {
            if (ui.values[0] == ui.values[1]) {
                return false;
            }

            $("#min_price").val(ui.values[0]);
            $("#max_price").val(ui.values[1]);

            $('#price-range-submit').show();
        }
    });

    $("#min_price").val($("#slider-range").slider("values", 0));
    $("#max_price").val($("#slider-range").slider("values", 1));
    // End Price Range tasks

});