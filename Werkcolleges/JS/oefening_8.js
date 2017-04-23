/**
 * Created by janmo on 13/04/2017.
 */
$(function(){

    $('form').submit(function(e){
       e.preventDefault();
    });


    $('form').keydown(function(e){

    var text =  $('#input').val();
    //console.log(text);

    if(e.keyCode == 13 && text !== ''){
        $('#output').append('<p>' + text + '</p>');
        $('input').val('');
    }
    else if((e.keyCode == 8) && (text === '')){
        $('#output p:last-child').remove();
    }



})




})