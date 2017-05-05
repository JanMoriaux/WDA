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

    //toevoegen aan winkelmandje via ajax
    $('.addToCartButton').click(function(e){

        e.preventDefault();
        var productId = this.id.substr(6);

        $.ajax(
            {
                type:'POST',
                url: 'index.php?controller=Ajax&action=addItemToCart',
                data: $('#add' + productId).serialize(),
                datatype: 'html',
                success: function(){
                    $('#add' + productId).replaceWith('<span class="label label-info pull-right">Toegevoegd</span>');
                }
            }
        )
    });

});