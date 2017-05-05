/**
 * Created by janmo on 5/05/2017.
 */

//TODO reference Frauke Vanderzijpe

$(function () {

    var validForm = false;

    //valideren bij focus verlies van input veld
    $("input").blur(function () {
        validateField($(this));
    });
    $("textarea").blur(function () {
        validateField($(this));
    });


    $('form').submit(function (e) {

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
        //server side gebeurt nog validatie van unieke productnaam en gebeurt de image upload
        if (!validForm) {
            e.preventDefault();
        }
    });

});

function validateField(el) {

    el.removeClass("error"); // verwijder de klasse error van het veld
    $(getErrorFieldId(el)).html('');

    switch (el.attr('id')) {
        case 'name':
            validateNameField(el);
            break;
        case 'description':
            validateDescriptionField(el);
            break;
        case 'image':
            validateImageField(el);
            break;
        case 'price':
            validatePriceField(el);
            break;
        case 'inStock':
            validateInStockField(el);
            break;
    }
}

//TODO name type validation.
function validateNameField(el) {

    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!hasValidLength(el, 2, 255)) {
        el.addClass('error');
        $(errorLabelId).html('Bevat minimum 2 en maximum 255 tekens');
    } else if(!isValidName(el)){
        el.addClass('error');
        $(errorLabelId).html('Bevat ongeldige tekens');
    }
}

function validateDescriptionField(el) {

    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!hasValidLength(el, 2, 255)) {
        el.addClass('error');
        $(errorLabelId).html('Bevat minimum 2 en maximum 255 tekens');
    }
}

function validateImageField(el) {

    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!isValidImageFileName(el)) {
        el.addClass('error');
        $(errorLabelId).html('Enkel afbeeldingen toegelaten.')
    }
}

function validatePriceField(el) {

    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!isNumeric(el)) {
        el.addClass('error');
        $(errorLabelId).html('Moet een getal zijn')
    } else if (!hasValidBoundariesIncl(el, 0.01, 50000)) {
        el.addClass('error');
        $(errorLabelId).html('Moet groter of gelijk aan 0.01 of kleiner dan of gelijk aan 50000 zijn');
    }
}

function validateInStockField(el) {

    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!isNumeric(el)) {
        el.addClass('error');
        $(errorLabelId).html('Moet een getal zijn')
    } else if (!isStrictPosInt(el)) {
        el.addClass('error');
        $(errorLabelId).html('Moet een positief geheel getal zijn');
    }
}


function getErrorFieldId(el) {
    return '#' + el.attr('id') + 'Error';
}


//TODO export to validationRules.js
//zie ook models/validation/validationRules

function valueProvided(el) {
    if (el.val().length == 0) {
        return false;
    }
    return true;
}

//http://stackoverflow.com/questions/6449611/how-to-check-whether-a-value-is-a-number-in-javascript-or-jquery
function isNumeric(el) {
    var number = el.val();
    number = number.replace(',', '.');

    return !isNaN(parseFloat(number)) && isFinite(number);
}

//http://stackoverflow.com/questions/14636536/how-to-check-if-a-variable-is-an-integer-in-javascript
function isStrictPosInt(el) {
    var number = el.val();
    number = number.replace(',', '.');

    var x = parseFloat(number);
    return !isNaN(number) && (x | 0) === x && x > 0;
}

//deze regex verschilt van de PCRE regex in models/validation/ValidationRules.php
//omdat javascript geen unicode categories toelaat
//we gaan hier enkel na of er een aantal vreemde tekens, waaronder cijfers, voorkomen
//in de naam. De rest van de validatie gebeurt server side
function isValidName(el){

    var regex = new RegExp(/^([^0-9%+=/#@&|{}£^\[\]()*_°]*)$/);
    return regex.test(el.val());

}

function hasValidBoundariesIncl(el, min, max) {

    if (!isNumeric(el))
        return false;

    var number = el.val();
    number = number.replace(',', '.');

    return parseFloat(number) >= min && parseFloat(number) <= max;
}

function hasValidLength(el, min, max) {

    return el.val().length >= min && el.val().length <= max;

}

function isValidBusNumber(el) {
    var regex = new RegExp(/^[a-zA-Z]{1,3}$/);
    return regex.test(el.val());
}

function isValidUserName(el) {
    var regex = new RegExp(/^[a-zA-Z0-9_-]{3,15}$/);
    return regex.test(el.val());
}

function isValidPassword(el) {
    var regex = new RegExp(/^.*(?=.{8,16})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&? "]).*$/);
    return regex.test(el.val());
}

function isValidEmailAddress(el) {
    var regex = new RegExp(/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))]))$/i);
    return regex.test(el.val());
}

function isValidImageFileName(el) {
    var regex = new RegExp(/\.(jpe?g|png|gif|bmp)$/i);
    return regex.test(el.val());
}
//todo end validationRules

