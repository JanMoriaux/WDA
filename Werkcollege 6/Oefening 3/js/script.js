/**
 * Created by janmo on 13/04/2017.
 */

$(function(){

    $('#success').hide();

    var errors = {
        'name' : '',
        'email' : '',
        'password' : '',
        'repeatpasswd' : ''
    };


    var validate = function(nameVal, emailVal, passwordVal, repeatpasswdVal){

        //empty the errors map
        for(var key in errors){
            errors[key] = '';
        }

        //validate required fields
        if(!valRequired(nameVal))
          errors['name'] = 'verplicht veld';
        if(!valRequired(emailVal))
            errors['email'] = 'verplicht veld';
        if(!valRequired(passwordVal))
            errors['password'] = 'verplicht veld';
        if(!valRequired(repeatpasswdVal))
            errors['repeatpasswd'] = 'verplicht veld';

        //validate password if passwd fields are filled in
        if(errors['password'] === '' && errors['repeatpasswd'] === ''){
            if(!valPassFormat(passwordVal)){
                var errormsg = 'ongeldig formaat';
                errors['password'] = errors['repeatpasswd'] = errormsg;
            }
            if(!valPassMatch(passwordVal,repeatpasswdVal)){
                var errormsg = 'wachtwoorden komen niet overeen';
                errors['password'] = errors['repeatpasswd'] = errormsg;
            }
        }
    };

    var valRequired = function(fieldVal){
        if(fieldVal== ''){
            return false;
        }
        return true;
    };

    var valPassMatch = function(passwordVal, repeatpasswdVal){
        if(passwordVal !== repeatpasswdVal){
            return false;
         }
         return true;
    };

    var valPassFormat = function(passwordVal){
        var re = new RegExp('^[a-zA-Z].{6,}[0-9]$');
        return re.test(passwordVal);
    }




    $('form').submit(function(e){
        e.preventDefault();

        $nameEl = $('#name');
        $emailEl = $('#email');
        $passwdEl = $('#password');
        $repPasswdEl = $('#repeatpasswd');

        var valid = true;
        validate($nameEl.val(),$emailEl.val(),$passwdEl.val(),$repPasswdEl.val());

        for(var key in errors){

            $('#error' + key).text(errors[key]);
            if(errors[key] !== ''){
                valid = false;
                $('#' +key).addClass('error-control');
            }
            else{
                $('#' +key).removeClass('error-control');
            }
        }

        if(valid){
            $('form').hide();
            $('#success').show();
        }
    })












})