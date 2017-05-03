/**
 * Created by janmo on 3/05/2017.
 */

$(function () {

    //categoryfilter via ajax call
    $('.categoryFilter').click(function (e) {

        e.preventDefault();
        var sender = this;
        var categoryId = sender.id.substr(8);

        $.ajax({
                type: 'GET',
                url: 'index.php?controller=Ajax&action=showCategory',
                datatype: 'html',
                data: {
                    id: categoryId
                },
                beforeSend: function () {
                    $('#pageContent').html(
                        '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Loading...</div>');
                },
                complete: function (data) {
                },
                success: function (data) {
                    var $productOverview = $(data);

                    $('#pageContent').empty();
                    $('#pageContent').append($productOverview.filter('#productOverview'));


                    $('.categoryFilter').removeClass("active");
                    $(sender).addClass("active");
                },
                fail: function (data) {
                }
            }
        );
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

    $('.addToCartButtonDetail').click(function(e){

        e.preventDefault();
        var productId = this.id.substr(6);

        $.ajax(
            {
                type:'POST',
                url: 'index.php?controller=Ajax&action=addItemToCart',
                data: $('#add' + productId).serialize(),
                datatype: 'html',
                success: function(){
                    $('#add' + productId).replaceWith('<h2><span class="label label-info">Toegevoegd</span></h2>');
                }
            }
        )
    });
});

