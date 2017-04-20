/**
 * Created by janmo on 14/04/2017.
 */

$(function(){
    $('#loginForm').submit(function(e){
        e.preventDefault();

        var form = $(this);

        if($('#name').val() != ''){
            document.cookie = "username=" + $('#name').val();
            document.location.href('chat.html');
        }
    })
})