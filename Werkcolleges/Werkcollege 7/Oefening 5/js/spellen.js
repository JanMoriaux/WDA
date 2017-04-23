/**
 * Created by janmo on 15/04/2017.
 */

var games = [];

$.ajax({
    url: 'data/spellen.xml',
    type: 'GET',
    dataType: 'xml',
    success: function(data){
        loadGames(data);
    },
    error: function (request,error) {
        console.log(request.responseText);
        console.log(error);
    }
});



var loadGames = function(data) {

    $(data).find('spel').each(function () {
        var $this = $(this);
        var game = {
            naam: $this.find('naam').html(),
            img: $this.find('img').html(),
            min: $this.attr('min'),
            max: $this.attr('max')
        };
        games.push(game);
    });

    console.log(games)
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
};

var sortByMinPlayers = function(gameArray){
    gameArray.sort(compare('min'));
};

var sortByMaxPlayers = function(gameArray){
    gameArray.sort(compare('max'));
};

var compare = function(property){
    return function(a,b){
        return a[property] < b[property] ? -1 : a[property] > b[property] ? 1 : 0;
    }
};

$(function () {
    loadGames();

    createTable(games);

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

        createTable(games);

    })











});

