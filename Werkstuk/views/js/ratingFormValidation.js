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
        case 'comment':
            validateCommentField(el);
            break;
    }
}

function validateCommentField(el) {

    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!hasValidLength(el,5,1000)) {
        el.addClass('error');
        $(errorLabelId).html('Minimaal 5 en maximaal 1000 tekens');
    }
}

function getErrorFieldId(el) {
    return '#' + el.attr('id') + 'Error';
}


