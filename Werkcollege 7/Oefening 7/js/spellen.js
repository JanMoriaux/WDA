/**
 * Created by janmo on 15/04/2017.
 */

var games = [];

function loadGames (data) {
    games = data.spellen;
    createTable(games);
};

var createTable = function(gameArray){

    //table and header
    var tableEl = $('<table>');
    tableEl.addClass('table table default');

    var headerRowEl = $('<tr>');

    var imgHeaderEl = $('<th>');
    imgHeaderEl.html('Afbeelding');
    var nameHeaderEl = $('<th>');
    nameHeaderEl.html('Naam');
    var minHeaderEl = $('<th>');
    minHeaderEl.html('Minimum # spelers');
    var maxHeaderEl = $('<th>');
    maxHeaderEl.html('Maximum # spelers');

    headerRowEl.append(imgHeaderEl).append(nameHeaderEl).append(minHeaderEl).append(maxHeaderEl);
    tableEl.append(headerRowEl);

    //add a row to the table for each object in gameArray
    $.each(gameArray,function(){

        var spel = $(this)[0];

        var imgCell = $('<td>');
        var imgEl = $('<img>');
        imgEl.attr('src', 'images/' + spel.img);
        imgCell.append(imgEl);

        var nameCell = $('<td>');
        var nameEl = $('<h2>');
        nameEl.html(spel.naam);
        nameCell.append(nameEl);

        var minCell = $('<td>');
        minCell.html(spel.min);

        var maxCell = $('<td>');
        maxCell.html(spel.max);

        var rowEl = $('<tr>');
        rowEl.append(imgCell).append(nameCell).append(minCell).append(maxCell);

        tableEl.append(rowEl);
    });


    $('#resultaten').html(tableEl);

};

var sortByName = function(gameArray){
    gameArray.sort(compare('naam'));
    createTable(games);
};

var sortByMinPlayers = function(gameArray){
    gameArray.sort(compare('min'));
    createTable(games);
};

var sortByMaxPlayers = function(gameArray){
    gameArray.sort(compare('max'));
    createTable(games);
};

var compare = function(property){
    return function(a,b){
        return a[property] < b[property] ? -1 : a[property] > b[property] ? 1 : 0;
    }
};

$(function () {
    $.ajax({
        url: 'data/spellen.json',
        type: 'GET',
        dataType: 'json',
        success: loadGames,
        error: function (request,error) {
            console.log(request.responseText);
            console.log(error);
        }
    });

    $('a').click(function(){
        console.log('click');
        switch($(this).attr('id')){
            case 'name':
                sortByName(games);
                break;
            case 'min':
                sortByMinPlayers(games);
                break;
            case 'max':
                sortByMaxPlayers(games);
                break;
        }
    })

});

