(function ($) {


// external js: masonry.pkgd.js

    $(document).ready(function () {

        $('.grid').masonry({
            itemSelector: '.grid-item',
        });

    });


})(jQuery);


function reJigAll() {

    jQuery('.grid div').css('display', 'block');
    jQuery('.grid').masonry('layout');

}

function reJig(keeper) {

    jQuery('.grid div').css('display', 'none');
    jQuery('.grid ' + keeper).css('display', 'block');
    jQuery('.grid').masonry('layout');

}

