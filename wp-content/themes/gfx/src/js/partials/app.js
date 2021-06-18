(function ($) {
    'use strict';

    // add sticky class for header after scroll
    $(window).on('scroll', function () {
        var scrollTop = $(document).scrollTop();
        if (scrollTop > 20) {
            $('.header').addClass('sticky');
        } else {
            $('.header').removeClass('sticky');
        }
    });

    // preventDefault for not a link link menu
    $('.not-a-link > a').on('click', function (e) {
        e.preventDefault();
    });

    // show submenu on click
    $('.header li.menu-item-has-children > a').on('click', function (e) {
        e.preventDefault();

        var subMenu = $(this).next('.sub-menu');
        var subMenus = $('.header .menu > li.menu-item-has-children > .sub-menu');
        var links = $('.header li.menu-item-has-children > a');
        var listItems = $('.header li.menu-item-has-children');

        if ($(window).width() > 960) {
            subMenus.fadeOut(100);
            links.removeClass('active');

            if (!subMenu.is(':visible')) {
                $(this).addClass('active');
                subMenu.fadeIn(200).css('display', 'flex');
            }
        } else {
            subMenus.slideUp(200);
            listItems.removeClass('active');
            links.removeClass('active');

            if (!subMenu.is(':visible')) {
                $(this).addClass('active').closest('li.menu-item-has-children').addClass('active');
                subMenu.slideDown(200).css('display', 'flex');
            }
        }
    });

    // close sub-menu on click not in sub-menus area
    $(document).mouseup(function (e) {
        if ($(window).width() > 960) {
            var links = $('.header .menu-holder > ul > li.menu-item-has-children > a');
            var submenu = $('.header .menu-holder > ul > li.menu-item-has-children > a').next('.sub-menu');
            if (!submenu.is(e.target)
                && submenu.has(e.target).length === 0) {
                links.removeClass('active');
                submenu.fadeOut(100);
            }
        }
    });

    // show mobile menu on click
    $('.header .burger-btn').on('click', function () {
        var menu = $('.header .menu-holder');

        if (menu.is(':visible')) {
            $('body').css('overflow', 'auto');
        } else {
            $('body').css('overflow', 'hidden');
        }

        $(this).toggleClass('active');
        menu.slideToggle(200);
    });

    // show added to cart popup
    var addedToCartPopup = $('.product-added-to-cart-popup');
    $('body').on('added_to_cart', function (event, fragments, cart_hash, button) {
        var addedProductName = button.attr('data-product_title');
        var productPopOutCloseBtn = $('.product-pop-out-close-btn');

        if (productPopOutCloseBtn.length) {
            productPopOutCloseBtn.trigger('click');
        }

        if (addedToCartPopup.length) {
            if (addedProductName) {
                addedToCartPopup.find('.product-name').text('“' + addedProductName + '”');
            }

            addedToCartPopup.fadeIn(200).css('display', 'flex');

            // close added to cart popup after 5 seconds
            if (addedToCartPopup.is(':visible')) {
                setTimeout(function () {
                    addedToCartPopup.fadeOut(200);
                }, 5000);
            }
        }
    });

    // close added to cart popup
    $('.product-added-to-cart-close-btn').on('click', function () {
        addedToCartPopup.fadeOut(200);
    });

    $(function () {
        objectFitImages('img');
    });
})(jQuery);