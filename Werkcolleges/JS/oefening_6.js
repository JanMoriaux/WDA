/**
 * Created by janmo on 13/04/2017.
 */

$(function(){

    $('input').on('click', function(){
        var color = $(this).val();
        //console.log(color);

        if(color === 'Rood'){
            $('#box').css('color','red');
        }
        else if(color === 'Groen'){
            $('#box').css('color','green');
        }
        else if(color === 'Blauw'){
            $('#box').css('color','blue');
        }
    })

})