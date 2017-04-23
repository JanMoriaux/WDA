/**
 * Created by janmo on 13/04/2017.
 */

$(document).ready(function(){

    $('div').mouseenter(function(e){

        $(e.target).animate(
            {
                'height' : '500px'
            }, 'slow'
        );
    })

    $('div').mouseleave(function(e){
        $(e.target).animate({
            'height' : '100px'
        }, 'slow');
    })















})