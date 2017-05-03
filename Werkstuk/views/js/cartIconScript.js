/**
 * Created by janmo on 3/05/2017.
 */
$(function () {
    //alle winkelmandje iconen verbergen
    $('span.glyphicon-shopping-cart').hide();

    //tonen bij mouseenter en mouseover, verbergen bij mouseleave
    $('div.productHolder').mouseover(function (e) {
        $thumbnail = $(e.target);
        $thumbnail.find('span.glyphicon-shopping-cart').show();
    }).mouseenter(function(e){
        $thumbnail = $(e.target);
        $thumbnail.find('span.glyphicon-shopping-cart').show();
    }).mouseleave(function(e){
        $('span.glyphicon-shopping-cart').hide();
    });

});