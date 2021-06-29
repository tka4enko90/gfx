(function ($) {
    $('.single-product-hero h2>img').hover(function () {
        var box = $(this).parent('h2').next('.compatible-with-box');
        if (box.length) {
            box.fadeToggle(200);
        }
    });
})
(jQuery);