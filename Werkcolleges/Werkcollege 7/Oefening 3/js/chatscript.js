/**
 * Created by janmo on 14/04/2017.
 */
if (document.cookie && document.cookie != '') {
    var cookies = document.cookie.split(';');

    console.log(cookies)

    var username = cookies[0].split('=')[1];
} else {
    document.location.href('logon.html');
}


var loadMessages = function(){
    $.ajax({
        type : 'GET',
        url : './log/chat_log.xml',
        dataType : 'XML',
        success : function(data){

            console.log('loaded messages');

            var posts = $(data).find('post');

            for(var i = 0; i < posts.length; i++){
                var article = $('<article></article>');

                var name = $('<strong></strong>');
                name.append($(posts[i]).find('name').text());

                var time = $('<time></time>');
                time.append($(posts[i]).find('time').text());

                var message = $('<p></p>');
                message.append($(posts[i]).find('message').text());

                article.append(name).append(time).append(message);

                $('#chat').append(article);

                $('#chat').scrollTop($('#chat')[0].scrollHeight);
            }
        },
        error : function(jqxhr,response){
            console.log(jqxhr.responseXML);
            console.log(response);
        }
    });


};

var currentTime = function(){
    var now = new Date();
    return now.getHours() + ':' + now.getMinutes();
};

$(function () {

    var invoerveldEl = $('#post');

    invoerveldEl.keypress(function (e) {
        if (e.keyCode == '13') {

            $.ajax({
                type: 'POST',
                url: 'save.php',
                data: {
                    time: currentTime(),
                    name: username,
                    message: invoerveldEl.val()
                },
                dataType: 'text',
                success: function () {
                    console.log('ok');
                },
                error: function (request, response) {
                    console.log(request.responseText);
                    console.log(response);
                }
            });
            invoerveldEl.val('');
        }
    });

    setInterval(loadMessages,1000);
});

