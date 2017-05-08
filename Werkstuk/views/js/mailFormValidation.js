/**
 * Created by janmo on 8/05/2017.
 */

$(function () {

    var validForm = false;

    //valideren bij focus verlies van input veld
    $("input").blur(function () {
        validateField($(this));
    });
    $("textarea").blur(function () {
        validateField($(this));
    });


    $('#userRegistrationForm').submit(function (e) {

        // elke input nog eens valideren voor het geval blur event niet gevangen werd
        $('input:not(:submit)').each(function () {
            validateField($(this));
        });
        $('textarea').each(function () {
            validateField($(this));
        });
        if ($('.error').length === 0)
            validForm = true;

        //indien nog errors houden we de submit tegen, anders wordt de default action uitgevoerd
        //voor server side validatie
        if (!validForm) {
            e.preventDefault();
        }
    });

});

function validateField(el) {

    el.removeClass("error"); // verwijder de klasse error van het veld
    $(getErrorFieldId(el)).html('');

    switch (el.attr('id')) {
        case 'emailaddress':
            validateEmailAddressField(el);
            break;
        case 'message':
            validateMessageField(el);
            break;
    }
}

function validateEmailAddressField(el) {

    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!isValidEmailAddress(el)) {
        el.addClass('error');
        $(errorLabelId).html('Geen geldig e-mailadres');
    }
}

function validateMessageField(el) {

    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!hasValidLength(el,2,5000)) {
        el.addClass('error');
        $(errorLabelId).html('Minimaal 2 en maximaal 5000 tekens');
    }
}

function getErrorFieldId(el) {
    return '#' + el.attr('id') + 'Error';
}