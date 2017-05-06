/**
 * Created by janmo on 6/05/2017.
 */
//zie ook models/validation/validationRules

function valueProvided(el) {
    if ($.trim(el.val()).length == 0) {
        return false;
    }
    return true;
}

//http://stackoverflow.com/questions/6449611/how-to-check-whether-a-value-is-a-number-in-javascript-or-jquery
function isNumeric(el) {
    var number = $.trim(el.val());
    number = number.replace(',', '.');

    return !isNaN(parseFloat(number)) && isFinite(number);
}

//http://stackoverflow.com/questions/14636536/how-to-check-if-a-variable-is-an-integer-in-javascript
function isStrictPosInt(el) {
    var number = $.trim(el.val());
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
    return regex.test($.trim(el.val()));

}

function hasValidBoundariesIncl(el, min, max) {

    if (!isNumeric(el))
        return false;

    var number = $.trim(el.val());
    number = number.replace(',', '.');

    return parseFloat(number) >= min && parseFloat(number) <= max;
}

function hasValidLength(el, min, max) {

    return $.trim(el.val()).length >= min && $.trim(el.val()).length <= max;

}

function isValidBusNumber(el) {
    var regex = new RegExp(/^[a-zA-Z]{1,3}$/);
    return regex.test($.trim(el.val()));
}

function isValidUserName(el) {
    var regex = new RegExp(/^[a-zA-Z0-9_-]{3,15}$/);
    return regex.test($.trim(el.val()));
}

function isValidPassword(el) {
    var regex = new RegExp(/^.*(?=.{8,16})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&? "]).*$/);
    return regex.test($.trim(el.val()));
}

function isValidEmailAddress(el) {
    var regex = new RegExp(/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))]))$/i);
    return regex.test($.trim(el.val()));
}

function isValidImageFileName(el) {
    var regex = new RegExp(/\.(jpe?g|png|gif|bmp)$/i);
    return regex.test($.trim(el.val()));
}
