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


    $('#productinsertform').submit(function (e) {

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
        //server side moet eerst de image upload en validatie gebeuren voor het product kan worden
        // toegevoegd aan de database
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
            validateUniqueProductName(el);
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

function validateUniqueProductName(el){

    if(!el.hasClass('error')){
        var productname = $.trim(el.val());
        var productid = $.trim($('#id').val());
        var errorLabelId = getErrorFieldId(el);

        $.ajax({
            type: 'GET',
            url: 'index.php?controller=Ajax&action=validateUniqueProductName',
            data: {
                productName : productname,
                productId : productid
            },
            beforeSend: function(){},
            complete:function(){},
            success:function(data){

                console.log('succes: ',data);

                var object = $.parseJSON(data);

                if(object["response"] === "false") {
                    el.addClass('error');
                    $(errorLabelId).html(el.val() + ' bestaat al');
                }
            },
            fail: function(data){}
        });
    }
}


function getErrorFieldId(el) {
    return '#' + el.attr('id') + 'Error';
}



