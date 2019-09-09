$(function() {

    $('#region').on('change', function() {
        var region = $(this).val(),
            cities = null;

        switch (region) {
            case "Extrême-Nord":
                cities = ["Maroua", "Kousséri", "Yagoua"];
                break;

            case "Nord":
                cities = ["Garoua", "Poli"];
                break;

            case "Adamaoua":
                cities = ["Ngaoundéré", "Tibati", "Banyo"];
                break;

            case "Est":
                cities = ["Bertoua", "Abong-Mbang", "Batouri"];
                break;

            case "Centre":
                cities = ["Yaoundé", "Nanga-Eboko", "Mfou", "Mbalmayo", "Éséka"];
                break;

            case "Sud":
                cities = ["Ebolowa", "Sangmélima", "Kribi"];
                break;

            case "Littoral":
                cities = ["Douala", "Nkongsamba", "Yabassi", "Édéa"];
                break;

            case "Ouest":
                cities = ["Bafoussam", "Mbouda", "Bandjoun", "Dschang", "Bangangté", "Foumban"];
                break;

            case "Nord-Ouest":
                cities = ["Bamenda", "Fundong", "Nkambé", "Ndop"];
                break;

            case "Sud-Ouest":
                cities = ["Buéa", "Limbé", "Mamfé", "Mundemba", "Kumba"];
                break;

            default:
                cities = [""];
                break;
        }

        $('#city').empty();

        for (let index = 0; index < cities.length; index++) {
            $('#city').append('<option value="' + cities[index] + '">' + cities[index] + '</option>');
        }
    });

    // $('.address-details-form').validate({
    //     rules: {
    //         zone: {
    //             required: true
    //         },
    //         first_name: {
    //             required: true,
    //             min: 2
    //         },
    //         last_name: {
    //             required: true,
    //             min: 2
    //         },
    //         email: {
    //             required: true,
    //             email: true
    //         },
    //         country: {
    //             required: true
    //         },
    //         phone: {
    //             required: true
    //         },
    //         address1: {
    //             required: true
    //         },
    //         region: {
    //             required: true
    //         },
    //         city: {
    //             required: true
    //         },
    //         zip: {
    //             number: true
    //         }
    //     },

    //     messages: {
    //         zone: {
    //             required: "You must choose a billing zone."
    //         },
    //         first_name: {
    //             required: "You first name is required.",
    //             min: "You first name must be at least 2 caracters."
    //         },
    //         last_name: {
    //             required: "You last name is required.",
    //             min: "You last name must be at least 2 caracters."
    //         },
    //         email: {
    //             required: "You email address is required for feedback and contact with our tailors.",
    //             email: "Please specified a correct email."
    //         },
    //         country: {
    //             required: "You country is required."
    //         },
    //         phone: {
    //             required: "At least one phone number is required."
    //         },
    //         address1: {
    //             required: "Please indicate at least one address line for shipping."
    //         },
    //         region: {
    //             required: "Your region is required for shipping."
    //         },
    //         city: {
    //             required: "Your city is required for shipping."
    //         },
    //         zip: {
    //             number: "The zip must be a number."
    //         }
    //     },

    //     submitHandler: function(form) {
    //         $('.address-details-form').submit();
    //     }
    // });

});