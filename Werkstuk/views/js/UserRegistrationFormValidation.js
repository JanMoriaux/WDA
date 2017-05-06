/**
 * Created by janmo on 6/05/2017.
 */
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
        case 'firstName':
            validateNameField(el);
            break;
        case 'lastName':
            validateNameField(el);
            break;
        case 'userName':
            validateUserNameField(el);
            validateUniqueUserName(el);
            break;
        case 'password':
            validatePasswordField(el);
            break;
        case 'repeatPassword':
            validatePasswordField(el);
            validateRepeatPasswordField(el);
            break;
        case 'email':
            validateEmailField(el);
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


//todo unique?
function validateUserNameField(el) {

    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!hasValidLength(el, 3, 15)) {
        el.addClass('error');
        $(errorLabelId).html('Bevat minimum 3 en maximum 15 tekens');
    } else if (!isValidUserName(el)) {
        el.addClass('error');
        $(errorLabelId).html('Mag enkel bestaan uit cijfers, letters, underscores (_) en koppeltekens');
    }
}

function validatePasswordField(el) {
    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!hasValidLength(el, 3, 16)) {
        el.addClass('error');
        $(errorLabelId).html('Bevat minimum 8 en maximum 16 tekens');
    } else if (!isValidPassword(el)) {
        el.addClass('error');
        $(errorLabelId).html('Moet bestaan uit een combinatie van cijfers, letters, !, #, $, %, &, en ?');
    }
}

function validateRepeatPasswordField(el) {

    var passwordEl = $('#password');

    if (!el.hasClass('error') && !passwordEl.hasClass('error')) {
        var errorLabelId = getErrorFieldId(passwordEl);

        if ($('#password').val() !== el.val()) {
            passwordEl.addClass('error');
            el.addClass('error');
            $(errorLabelId).html('Wachtwoord waarden komen niet overeen')
        }
    }
}

function validateEmailField(el) {

    var errorLabelId = getErrorFieldId(el);

    if (!valueProvided(el)) {
        el.addClass('error');
        $(errorLabelId).html('Verplicht veld');
    } else if (!hasValidLength(el, 3, 254)) {
        el.addClass('error');
        $(errorLabelId).html('Bevat minimum 3 en maximum 254 tekens');
    } else if (!isValidEmailAddress(el)) {
        el.addClass('error');
        $(errorLabelId).html('Geen geldig email-adres');
    }
}

function validateUniqueUserName(el) {

    if (!el.hasClass('error')) {
        var username = $.trim(el.val());
        var errorLabelId = getErrorFieldId(el);

        $.ajax({
            type: 'GET',
            url: 'index.php?controller=Ajax&action=validateUniqueUserName',
            data: {userName: username},
            beforeSend: function () {
            },
            complete: function () {
            },
            success: function (data) {

                var object = $.parseJSON(data);

                if (object["response"] === "false") {
                    el.addClass('error');
                    $(errorLabelId).html(el.val() + ' is niet meer beschikbaar');
                }
            },
            fail: function (data) {}
        });
    }
}

function getErrorFieldId(el) {
    return '#' + el.attr('id') + 'Error';
}





