/**
 * Created by janmo on 13/04/2017.
 */

$(function(){

    $('form').submit(function(e){
        e.preventDefault();
        $('body').append($('#invoer').val() + '<br />');
        $('#invoer').val('');
    });
});