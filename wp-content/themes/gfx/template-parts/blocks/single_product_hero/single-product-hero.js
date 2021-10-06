(function ($) {
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

            var scrollY = $(window).scrollTop();
            body.addClass('opened-modal');
            body.css('top', `-${scrollY}px`);
        });
    }

    var closeProductTrailerPopupBtn = $('.close-product-trailer-popup-btn');
    if(closeProductTrailerPopupBtn.length) {
        closeProductTrailerPopupBtn.on('click', function() {
            var scrollY = body.css('top');
            body.removeClass('opened-modal');
            body.css('top', '');
            window.scrollTo(0, parseInt(scrollY) * -1);

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

    if(productTrailerPopup.length && closeProductTrailerPopupBtn.length) {
        var element = $(productTrailerPopup).find('.holder');

        $(document).mouseup(function (e) {
            if (productTrailerPopup.is(':visible') && !element.is(e.target) && element.has(e.target).length === 0) {
                closeProductTrailerPopupBtn.trigger('click');
            }
        });
    }
})
(jQuery);