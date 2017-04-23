/**
 * Created by janmo on 13/04/2017.
 */

$(function(){

    var id = '';

    $('.box').click(function(e){

        var $clickedBox = $(e.target);

        //no box selected
        if(id == ''){
            id = '#' + $clickedBox.attr('id');
            $clickedBox.toggleClass('active');
        }
        //one box selected
        else{

            $(id).toggleClass('active');

            $(id).animate(
                {
                    'top' : $clickedBox.position().top,
                    'left' : $clickedBox.position().left
                },
                {
                    queue : false,
                    duration : 600
                }
            );

            $clickedBox.animate(
                {
                    'top' : $(id).position().top,
                    'left' : $(id).position().left
                },
                {
                    queue : false,
                    duration : 600
                }
            );

            id = '';


        }

    })











})