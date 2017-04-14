/**
 * Created by janmo on 13/04/2017.
 */


$(function(){

    $('.blokje').click(function(e){
        var thisCube = e.target;
        $('body').append(thisCube);
    })

})


