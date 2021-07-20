(function ($) {
    $('.single-product-hero h2>img').hover(function () {
        var box = $(this).parent('h2').next('.compatible-with-box');
        if (box.length) {
            box.fadeToggle(200);
        }
    });

    var body = $('body');
    var header = $('header');
    var openProductTrailerPopup = $('.open-product-trailer-popup');
    var productTrailerPopup = $('.product-trailer-popup');

    if(openProductTrailerPopup.length && productTrailerPopup.length) {
        openProductTrailerPopup.on('click', function () {

            var margin = window.innerWidth - body.width();
            if (margin && header.length) {
                header.css('width', 'calc(100% - ' + margin + 'px)');
                body.css('width', 'calc(100% - ' + margin + 'px)');
            }
            if (body.length) {
                body.css('overflow', 'hidden');
            }

            productTrailerPopup.fadeIn(200);

            var iframe = productTrailerPopup.find('iframe');
            if(iframe.length) {
                iframe[0].src += "?autoplay=1";
            }
        });
    }

    var closeProductTrailerPopupBtn = $('.close-product-trailer-popup-btn');
    if(closeProductTrailerPopupBtn.length) {
        closeProductTrailerPopupBtn.on('click', function() {
            var productTrailerPopup = $(this).closest('.product-trailer-popup');
            productTrailerPopup.fadeOut(200);

            var iframe = productTrailerPopup.find('iframe');
            if(iframe.length) {
                var src = iframe[0].src;
                var updatedSrc = src.split('?')[0];
                iframe[0].src = updatedSrc;
            }

            setTimeout(function () {
                if (header.length && body.length) {
                    header.css('width', '100%');
                    body.css('width', '100%');
                    body.css('overflow', 'auto');
                }
            }, 200);
        });
    }
})
(jQuery);