jQuery( document ).ready(function() {



    var $container = jQuery('.grid');

    $container.packery({
        itemSelector: '.grid-item',
        gutter: 0,
        "percentPosition": true
    });
});

function reJigAll() {

    jQuery('.grid div').css('display', 'block');
    jQuery('.grid').packery('layout');

}

function reJig(keeper) {

    jQuery('.grid div').css('display', 'none');
    jQuery('.grid ' + keeper).css('display', 'block');
    jQuery('.grid').packery('layout');



}
