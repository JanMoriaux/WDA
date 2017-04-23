/**
 * Created by janmo on 13/04/2017.
 */
$(document).ready(function(){
    var height = $('li').height();

    var min = 0;
    var max = ($('li').length - 1) * height;

    var animating = false;

    var moveSliderUp = function(){
        if(!animating && Math.round($('ul').position().top) > -max){
            animating = true;
            $('ul').animate(
                {
                    top : '-=' + height
                },
                {
                    'duration' : 'slow',
                    'complete' : function(){
                        animating = false;
                    }
                });
        }

    };

    var moveSliderDown = function(){
        if(!animating && Math.round($('ul').position().top) < 0){
            animating = true;
            $('ul').animate(
                {
                    top : '+=' + height
                },
                {
                    'duration' : 'slow',
                    'complete' : function(){
                        animating = false;
                    }
                });
        }
    };

    $('button').click(function(e){
        var buttonId = $(this).attr('id');

        switch (buttonId){
            case 'up':
                moveSliderUp();
                break;
            case 'down':
                moveSliderDown();
                break;
        }
    });
});