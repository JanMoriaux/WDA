/**
 * Created by janmo on 13/04/2017.
 */
$(document).ready(function () {

    $('#register').submit(function (e) {
        e.preventDefault();

        var data = $('#register').serialize();

        $.ajax(
            {
                type: 'GET',
                url: $('#register').attr('action'),
                dataType : 'json',
                data: data,
                success: function (data) {

                    $('#response').html('');
                    $('#register').remove();

                    if (data.success) {
                        $('#response').html(data.success);
                    }
                    if (data.error) {
                        $('#error').html(data.error);
                    }
                },
                beforeSend: function () {
                    $('#response').html('Loading');
                },
                error : function(request,error){
                    console.log(arguments);
                    $('#response').html('');
                    $('#response').html(error);
                    console.log(request.responseText);
                }
            }
        )
    });
});