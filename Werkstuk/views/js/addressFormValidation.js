/**
 * Created by janmo on 8/05/2017.
 */

//TODO reference Frauke Vanderzijpe

$(function () {

    var validForm = false;

    //valideren bij focus verlies van input veld
    $("input").blur(function () {
        validateField($(this));
    });


    $('#userRegistrationForm').submit(function (e) {

        // elke input nog eens valideren voor het geval blur event niet gevangen werd
        $('input:not(:submit)').each(function () {
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
        case 'street':
            validateNameField(el);
            break;
        case 'number':
            validateNumberField(el);
            break;
        case 'bus':
            validateBusField(el);
            break;
        case 'postalCode':
            validateNumberField(el);
            validatePostalCodeField(el);
            break;
        case 'city':
            validateNameField(el);
            break;
    }
}

function validateNameField(el) {

    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!hasValidLength(el, 2, 255)) {
        el.addClass('error');
        $(errorLabelId).html('Bevat minimum 2 en maximum 255 tekens');
    } else if (!isValidName(el)) {
        el.addClass('error');
        $(errorLabelId).html('Bevat ongeldige tekens');
    }
}

function validateNumberField(el) {

    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!isNumeric(el)) {
        el.addClass('error');
        $(errorLabelId).html('Gelieve een getalwaarde in te voeren');
    } else if (!isStrictPosInt(el)) {
        el.addClass('error');
        $(errorLabelId).html('Gelieve een positief geheel getal in te voeren');
    }
}

function validateBusField(el){

    var errorLabelId = getErrorFieldId(el);

    if(!valueProvided(el)){
        return;
    }
    if (!isValidBusNumber(el)) {
        el.addClass('error');
        $(errorLabelId).html('Bestaat uit maximaal drie letters');
    } else if (!isStrictPosInt(el)) {
        el.addClass('error');
        $(errorLabelId).html('Gelieve een positief geheel getal in te voeren');
    }
}

function validatePostalCodeField(el){

    if(!el.hasClass('error')){

        var errorLabelId = getErrorFieldId(el);

        if(!hasValidBoundariesIncl(el,1000,9999)){
            el.addClass('error');
            $(errorLabelId).html('Gelieve een waarde tussen 1000 en 9999 in te vullen');
        }
    }
}

function getErrorFieldId(el) {
    return '#' + el.attr('id') + 'Error';
}



