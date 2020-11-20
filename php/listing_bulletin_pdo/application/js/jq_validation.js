'use strict';

$(function(){

    jQuery.validator.setDefaults({
        debug: false, // avec true le formulaire n'est pas soumis
        success: "valid"
    });
    
    $("#form_add_eleve").validate({

        submitHandler: function(form) {
            form.submit();
        },

        invalidHandler: function(event, validator)
        {
            let errors = validator.numberOfInvalids();

            if (errors) {
                
                let message = (errors == 1) ? ' Vous avez ' + errors + ' erreur à corriger' : ' Vous avez ' + errors + ' erreurs à corriger';
                $('div#error span').html(message); 
                $('div#error').show();
            }
            else{
                $('div#error').hide();
            }
        },

        rules: {
            nom: {
                required: true,
                minlength: 2
            },
            prenom: {
                required: true,
                minlength: 2
            },
            date_naissance: {
                required: true,
                dateISO: true 
            },
            moyenne: {
                required: true,
                minlength: 2,
                digits: true,
                maxlength: 2
            },
            appreciation: {
                required: true,
                minlength: 2
            },
        },
        messages: {
            nom: {
                required: ' Vous êtes obliger de mettre le nom de l\'élève',
                minlength: jQuery.validator.format(' Le nom de l\'élève doit contenir minimun 2 caractères')
            },
            prenom: {
                required: ' Vous êtes obliger de mettre le prénom de l\'élève',
                minlength: jQuery.validator.format(' Le prénom de l\'élève doit contenir minimun 2 caractères')
            },
            date_naissance: {
                required: ' Vous êtes obliger de mettre la date de naissance de l\'élève',
                dateISO: jQuery.validator.format(' La date de naissance de l\'élève doit être au bon format ex : 01/01/2000')
            },
            moyenne: {
                required: ' Vous êtes obliger de mettre la moyenne de l\'élève',
                minlength: jQuery.validator.format(' La moyenne de l\'élève doit contenir minimun 2 caractères'),
                digits: ' La moyenne doit être un nombre entier',
                maxlength: jQuery.validator.format(' La moyenne de l\'élève doit contenir maximun 2 caractères')
            },
            appreciation: {
                required: ' Vous êtes obliger de mettre l\'appreciation de l\'élève',
                minlength: jQuery.validator.format(' L\'appreciation de l\'élève doit contenir minimun 2 caractères')
            },
        } 
    });
});