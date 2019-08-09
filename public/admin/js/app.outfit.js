$(function() {

    // Registering of an outfit
    // $('.outfit-save-form').validate({
    //     rules: {
    //         name: {
    //             required: true
    //         },
    //         price: {
    //             required: true,
    //             number: true
    //         },
    //         category: {
    //             required: true
    //         },
    //         type: {
    //             required: true,
    //             number: true
    //         },
    //         availibility: {
    //             required: true
    //         },
    //         context: {
    //             required: true
    //         },
    //         description: {
    //             required: true
    //         },
    //         specification: {
    //             required: true
    //         },
    //         photos: {
    //             required: true,
    //             extension: 'jpg|jpeg|bmp|png'
    //         }
    //     },

    //     messages: {
    //         name: {
    //             required: "The name field is required."
    //         },
    //         price: {
    //             required: "The price field is required.",
    //             number: "The price must be a number."
    //         },
    //         category: {
    //             required: "You must choose a category for this outfit."
    //         },
    //         type: {
    //             required: "You must select a type for this outfit.",
    //             number: "The type ID must be a number."
    //         },
    //         availibility: {
    //             required: "You must define the availibility of this outfit."
    //         },
    //         context: {
    //             required: "The context field is required."
    //         },
    //         description: {
    //             required: "The description field is required."
    //         },
    //         specification: {
    //             required: "The specification field is required."
    //         },
    //         photos: {
    //             required: "You have to provided at least one photo for this outfit.",
    //             extension: 'The photo must be a .jpg, a .jpeg, a .bmp or a .png file.'
    //         }
    //     },

    //     submitHandler: function(form) {
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });

    //         $('#btn-outfit-save').html('<span class="btn-inner--text"> <i class="fas fa-spinner mr-1"></i> SAVING IN PROGRESS... </span>');

    //         var request = $.ajax({
    //             type: 'POST',
    //             url: '/admin/outfit',
    //             data: $('.outfit-save-form').serialize(),
    //             contentType: false,
    //             cache: false,
    //             processData: false
    //         });

    //         request.done(function(response) {
    //             $('#btn-outfit-save').html('<i class="fas fa-check-circle"></i> SAVE THIS OUTFIT');

    //             fadeAlert((response.status) ? 'success' : 'danger', response.msg);
    //         });

    //         request.fail(function() {
    //             $('#btn-outfit-save').html('<i class="fas fa-check-circle"></i> SAVE THIS OUTFIT' + $('.outfit-save-form').serialize());

    //             fadeAlert('danger', "An script error occured while saving this outfit!");
    //         });

    //         $('.outfit-save-form').trigger('reset');
    //     }

    // });

    // Dashboard Outfits search
    filterOutfit('#men-outfit-search', '#men-list tr');
    filterOutfit('#women-outfit-search', '#women-list tr');
    filterOutfit('#children-outfit-search', '#children-list tr');

});