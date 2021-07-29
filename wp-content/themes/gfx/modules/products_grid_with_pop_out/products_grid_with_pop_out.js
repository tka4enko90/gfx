(function ($) {
    var body = $('body');
    var wrapper = $('body > .wrapper');
    var header = $('.header');
    var productCardOpenPopOut = $('.product-card-open-pop-out');

    // open product pop out
    if (productCardOpenPopOut.length) {
        productCardOpenPopOut.on('click', function () {
            var popOut = $('.product-pop-out');
            var popOutInfo = JSON.parse($(this).attr('data-product-pop-out'));

            var productTrailerVideoHolder = popOut.find('.product-trailer-video-holder');
            var buttonsHolder = popOut.find('.buttons-holder');
            var addToCartLink = buttonsHolder.find('a.add_to_cart_button');
            var moreInfoLink = buttonsHolder.find('a.more-info-link');
            var productTitle = popOut.find('.product-title');
            var productCategory = popOut.find('.product-category');
            var productCompatibleWith = popOut.find('.compatible-with');
            var previewsHolder = popOut.find('.previews-holder');

            // clear blocks in popout
            clearPopOut(popOut);

            if (popOutInfo) {
                if (!popOut.is(':visible')) {
                    var margin = window.innerWidth - body.width();
                    if (margin && header.length && popOut.length) {
                        header.css('width', 'calc(100% - ' + margin + 'px)');
                        body.css('width', 'calc(100% - ' + margin + 'px)');
                    }

                    if (body.length) {
                        body.css('overflow', 'hidden');
                    }

                    // Insert product trailer
                    if (popOutInfo.product_trailer) {
                        if (buttonsHolder.length) {
                            if ($(window).width() < 576) {
                                buttonsHolder.before('<div class="product-trailer product-trailer-video-holder"><video playsinline autoPlay="autoplay" loop="loop" muted="muted">\n' +
                                    '                <source src="' + popOutInfo.product_trailer.url + '" type="' + popOutInfo.product_trailer.mime_type + '">\n' +
                                    '            </video></div>');
                            } else {
                                buttonsHolder.before('<div class="product-trailer product-trailer-video-holder"><video playsinline autoPlay="autoplay" loop="loop" muted="muted">\n' +
                                    '                <source src="' + popOutInfo.product_trailer.url + '" type="' + popOutInfo.product_trailer.mime_type + '">\n' +
                                    '            </video></div>');
                            }
                        }
                        productTrailerVideoHolder.find('video').load();
                        buttonsHolder.addClass('product-trailer-visible');
                    }

                    // Insert product price and add to cart link
                    if (popOutInfo.product_price && addToCartLink.length && popOutInfo.product_add_to_cart_url && popOutInfo.product_id && popOutInfo.product_title) {
                        addToCartLink.attr('href', popOutInfo.product_add_to_cart_url);
                        addToCartLink.attr('data-product_id', popOutInfo.product_id);
                        addToCartLink.attr('data-product_title', popOutInfo.product_title);
                        addToCartLink.html('Add to cart - ' + popOutInfo.product_price);

                        if (popOutInfo.product_sku) {
                            addToCartLink.attr('data-product_sku', popOutInfo.product_sku);
                        }
                    }

                    // Insert more info link
                    if (popOutInfo.product_permalink && moreInfoLink.length) {
                        moreInfoLink.attr('href', popOutInfo.product_permalink);
                    }

                    // Insert product title
                    if (popOutInfo.product_title && productTitle.length) {
                        productTitle.text(popOutInfo.product_title);
                    }

                    // Insert product category
                    if (popOutInfo.product_category && productCategory.length) {
                        productCategory.text(popOutInfo.product_category);
                    }

                    // Insert compatible with block
                    if (popOutInfo.compatible_with && productCompatibleWith.length) {
                        productCompatibleWith.append('<div class="title">Compatible With</div>');
                        $(popOutInfo.compatible_with).each(function (index) {
                            var icon = popOutInfo.compatible_with[index].icon;
                            var name = popOutInfo.compatible_with[index].name;

                            if (index === 0) {
                                productCompatibleWith.append('<div class="items"><div class="item">\n' +
                                    '                        <img src="' + icon + '" alt="">\n' +
                                    '<span class="name">' + name + '</span>\n' +
                                    '                    </div></div>');
                            } else {
                                productCompatibleWith.find('.items').append('<div class="item">\n' +
                                    '                        <img src="' + icon + '" alt="">\n' +
                                    '<span class="name">' + name + '</span>\n' +
                                    '                    </div>');
                            }
                        });
                    }

                    // Insert assets preview
                    if (popOutInfo.assets_preview && previewsHolder.length) {
                        previewsHolder.append('<div class="preview assets-preview">\n' +
                            '                            <div class="preview-name">Assets Preview:</div>\n' +
                            '                            <div class="video-holder">\n' +
                            '                                <video class="pop-out-video" >\n' +
                            '                                    <source src="' + popOutInfo.assets_preview.url + '"\n' +
                            '                                            >\n' +
                            '                                </video>\n' +
                            '                            </div>\n' +
                            '                        </div>');
                        previewsHolder.find('.assets-preview video')[0].load();
                    }

                    // Insert alert preview
                    if (popOutInfo.alert_preview && previewsHolder.length) {
                        previewsHolder.append('<div class="preview alert-preview">\n' +
                            '                            <div class="preview-name">Alert Preview:</div>\n' +
                            '                            <div class="video-holder">\n' +
                            '                                <video class="pop-out-video">\n' +
                            '                                    <source src="' + popOutInfo.alert_preview.url + '">\n' +
                            '                                </video>\n' +
                            '                            </div>\n' +
                            '                        </div>');
                        previewsHolder.find('.alert-preview video')[0].load();
                    }

                    // Insert screen preview
                    if (popOutInfo.screen_preview && previewsHolder.length) {
                        previewsHolder.append('<div class="preview screen-preview">\n' +
                            '                            <div class="preview-name">Screen Preview:</div>\n' +
                            '                            <div class="video-holder">\n' +
                            '                                <video class="pop-out-video" loop="loop" muted="muted" playsinline>\n' +
                            '                                    <source src="' + popOutInfo.screen_preview.url + '"\n' +
                            '                                            type="' + popOutInfo.screen_preview.mime_type + '">\n' +
                            '                                </video>\n' +
                            '                            </div>\n' +
                            '                        </div>');
                        previewsHolder.find('.screen-preview video')[0].load();
                    }

                    wrapper.addClass('is-blurred');
                    popOut.fadeIn(200).css('display', 'flex');

                    var scrollY = $(window).scrollTop();
                    body.addClass('opened-modal');
                    body.css('top', `-${scrollY}px`);
                }
            }
        });
    }

    // close product pop out
    var productPopOutCloseBtn = $('.product-pop-out-close-btn');
    if (productPopOutCloseBtn.length) {
        productPopOutCloseBtn.on('click', function () {
            var popOut = $(this).closest('.product-pop-out');
            if (popOut.length) {
                wrapper.removeClass('is-blurred');

                var scrollY = body.css('top');
                body.removeClass('opened-modal');
                body.css('top', '');
                window.scrollTo(0, parseInt(scrollY) * -1);

                popOut.fadeOut(200);

                setTimeout(function () {
                    if (header.length && body.length) {
                        header.css('width', '100%');
                        body.css('width', '100%');
                        body.css('overflow', 'auto');
                    }
                }, 200);
            }
        });
    }

    $(document).mouseup(function (e) {
        var popOut = $('.product-pop-out .popup');

        if (popOut.length && popOut.is(':visible')
            && !popOut.is(e.target) && popOut.has(e.target).length === 0) {

            var productPopOutCloseBtn = popOut.find('.product-pop-out-close-btn');
            if (productPopOutCloseBtn.length) {
                productPopOutCloseBtn.trigger('click');
            }
        }
    });

    // switch video on click in product pop out
    var popOutVideoHolder = $('.previews-holder');
    if (popOutVideoHolder.length) {
        popOutVideoHolder.on('click', '.pop-out-video', function () {
            var productTrailerVideoBlock = $('.product-trailer-video-holder');
            var videoTag = $(this).clone().prop('autoplay', 'autoplay').attr('playsinline', '');

            if (productTrailerVideoBlock.length && videoTag.length) {
                productTrailerVideoBlock.find('video').remove();
                productTrailerVideoBlock.append(videoTag);
            }
        });
    }

    // clear blocks in popout
    function clearPopOut(popOut) {
        var productTrailerVideoHolder = popOut.find('.product-trailer-video-holder');
        var previewsHolder = popOut.find('.previews-holder');
        var addToCartLink = popOut.find('a.add_to_cart_button');
        var moreInfoLink = popOut.find('a.more-info-link');
        var productTitle = popOut.find('.product-title');
        var productCategory = popOut.find('.product-category');
        var buttonsHolder = popOut.find('.buttons-holder');
        var productCompatibleWith = popOut.find('.compatible-with');

        productTrailerVideoHolder.remove();
        buttonsHolder.removeClass('product-trailer-visible');
        previewsHolder.html('');
        addToCartLink.attr('href', '').attr('data-product_id', '').attr('data-product_sku', '').html('');
        moreInfoLink.attr('href', '');
        productTitle.text('');
        productCategory.text('');
        productCompatibleWith.html('');
    }
})(jQuery);