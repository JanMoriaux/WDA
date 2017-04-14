/**
 * Created by janmo on 13/04/2017.
 */

$(function(){

    console.log($('body'));
    console.log($('p'));
    console.log($('section p'));
    console.log($('nav#mainNav li'));
    console.log($('p.contentTxt strong'));
    console.log($('h1').text());
    console.log($('p.contentTxt:odd'));
    console.log($('#active a').attr('href'));
    console.log($('p.contentTxt:first'));

    $('p.contentTxt:odd').css("background-color",'#eee');
    $('#active a').css({
        'color': 'green',
        'background-color' : 'red'
    }).attr('href','#');

    var new_content = '<strong>Lorem</strong> Ipsum';
    $('section p:last').html(new_content);

    $('#active a').on('click',function(){
        console.log('jQuery events');
    })



})