/**
 * Created by janmo on 15/04/2017.
 */

var loadGames = function(data){

    var table = $('<table></table>');
    table.addClass('table');

    var headerRow = $('<tr></tr>');

    var afbeeldingHeader = $('<th></th>');
    afbeeldingHeader.text('Afbeelding');

    var titelHeader = $('<th></th>');
    titelHeader.text('Titel');

    var minSpelersHeader = $('<th></th>');
    minSpelersHeader.text('Minimum # spelers');

    var maxSpelersHeader = $('<th></th>');
    maxSpelersHeader.text('Minimum # spelers');

    table.append(headerRow).append(afbeeldingHeader).append(titelHeader).append(minSpelersHeader).append(maxSpelersHeader);


    $(data).find('spel').each(function () {
        var $spel = $(this);

        var name = $('<h2></h2>').html($spel.find('naam').html());
        console.log(name);
        var nameCell = $('<td></td>').append(name);

        var source = 'images/' + $spel.find('img').text();
        var image = $('<img>').attr('src',source);
        image.attr('alt', $spel.find('naam').html());
        var imageCell = $('<td></td>').append(image);

        var minPlayersCell = $('<td></td>').html($spel.attr('min'));
        var maxPlayersCell = $('<td></td>').html($spel.attr('max'));

        var gameRow = $('<tr></tr>');
        gameRow.append(imageCell).append(nameCell).append(minPlayersCell).append(maxPlayersCell);

        table.append(gameRow);
    });

    $('#resultaten').append(table);

};


$(function () {
    $.ajax({
        url: 'data/spellen.xml',
        type: 'GET',
        dataType: 'xml',
        success: loadGames,
        error: function (request,error) {
            console.log(request.responseText);
            console.log(error);
        }
    })
});

