(function ($) {
    'use strict';
    var body = $('body');

    // add sticky class for header after scroll
    $(window).on('scroll', function () {
        var header = $('.header');
        var scrollTop = $(document).scrollTop();

        if (header.length) {
            if (scrollTop > 20) {
                header.addClass('sticky');
            } else {
                header.removeClass('sticky');
            }
        }
    });

    // preventDefault for not a link items in menu
    $('.not-a-link > a').on('click', function (e) {
        e.preventDefault();
    });

    // show submenu on hover/click
    var hasChildrenListItem = $('.header .menu > li.menu-item-has-children');
    var hasChildrenLink = hasChildrenListItem.find('a:first');

    if ($(window).width() > 960) {
        if (hasChildrenListItem.length) {
            hasChildrenListItem.hover(function () {

                var subMenu = $(this).find('a:first').next('.sub-menu');
                var subMenus = $('.header .menu > li.menu-item-has-children > .sub-menu');

                if (subMenus.length) {
                    subMenus.fadeOut(100);
                    hasChildrenListItem.removeClass('active');

                    if (!subMenu.is(':visible')) {
                        $(this).addClass('active');
                        subMenu.fadeIn(200).css('display', 'flex');
                    }
                }
            });
        }
    } else {
        if (hasChildrenListItem.length) {
            hasChildrenListItem.on('click', function () {
                var link = $(this).find('a:first');
                var subMenu = link.next('.sub-menu');
                var subMenus = $('.header .menu > li.menu-item-has-children > .sub-menu');

                if (subMenus.length && hasChildrenLink.length) {
                    subMenus.slideUp(200);
                    hasChildrenLink.removeClass('opened');
                }

                if (subMenu.length && !subMenu.is(':visible') && link.length) {
                    link.addClass('opened');
                    subMenu.slideDown(200).css('display', 'flex');
                }
            });
        }
    }

    // show mobile menu on click
    $('.header .burger-btn').on('click', function () {
        var menu = $('.header .menu-holder');

        if (menu.is(':visible')) {
            body.css('overflow', 'auto');
        } else {
            body.css('overflow', 'hidden');
        }

        $(this).toggleClass('active');
        menu.slideToggle(200);
    });

    // show added to cart popup
    var addedToCartPopup = $('.product-added-to-cart-popup');
    if (body.length) {
        body.on('added_to_cart', function (event, fragments, cart_hash, button) {
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
    }

    // close added to cart popup
    $('.product-added-to-cart-close-btn').on('click', function () {
        addedToCartPopup.fadeOut(200);
    });

    // smooth scroll
    var scrollDownLink = $('.scroll-down-link');
    if (scrollDownLink.length) {
        scrollDownLink.on('click', function (e) {
            e.preventDefault();

            var scrollHere = $(this).closest('section').next('.scroll-here');
            if (scrollHere.length) {
                var top = scrollHere.offset().top;

                $('body,html').animate({scrollTop: top - 40}, 500);
            }
        });
    }

    // Downloads table pagination
    var downloadsTable = $('.woocommerce-table--order-downloads');
    var downloadsPagination = $('.my-account-downloads-pagination');

    if (downloadsPagination.length) {
        var downloadsPaginationButton = downloadsPagination.find('button');
        var downloadsPaginationPageNumber = downloadsPagination.find('button.page-number');
        var prevButton = downloadsPagination.find('button.prev');
        var nextButton = downloadsPagination.find('button.next');

        if (downloadsPaginationButton.length) {
            downloadsPaginationButton.on('click', function () {
                var self = $(this);

                var downloads = downloadsPagination.attr('data-downloads');
                var downloadsPerPage = downloadsPagination.attr('data-downloads-per-page');
                var currentPage = parseInt(downloadsPagination.attr('data-downloads-current-page'));
                var lastPage = parseInt(downloadsPagination.attr('data-downloads-last-page'));
                var offset = 0;

                prevButton.removeClass('hidden');
                nextButton.removeClass('hidden');

                // next btn
                if (self.hasClass('prev')) {
                    var prevPage = currentPage - 1;

                    offset = prevPage * downloadsPerPage;
                    changeActivePage(prevPage);
                }
                // prev btn
                else if (self.hasClass('next')) {
                    var nextPage = currentPage + 1

                    offset = nextPage * downloadsPerPage;
                    changeActivePage(nextPage);
                }
                // page number
                else {
                    var pageNum = parseInt(self.text());
                    offset = pageNum * downloadsPerPage;

                    downloadsPagination.attr('data-downloads-current-page', pageNum);

                    downloadsPaginationButton.removeClass('current');
                    self.addClass('current');
                }

                currentPage = parseInt(downloadsPagination.attr('data-downloads-current-page'));
                checkPrevNextButtons(currentPage, lastPage);

                $.ajax({
                    url: ajaxurl.url,
                    type: 'POST',
                    data: {
                        action: 'downloads_pagination',
                        downloads: downloads,
                        downloadsOffset: offset - 1,
                        downloadsPerPage: downloadsPerPage,
                    },
                    success: function (data) {
                        if (data.content && downloadsTable.length) {
                            $(downloadsTable).html(data.content);
                        }
                    }
                });
            });

            function changeActivePage(currentPage) {
                downloadsPaginationPageNumber.removeClass('current');
                downloadsPagination.attr('data-downloads-current-page', currentPage);

                // find and set current class for page
                downloadsPaginationPageNumber.each(function () {
                    var self = $(this);
                    var page = parseInt(self.text());

                    if (page == currentPage) {
                        self.addClass('current');
                    }
                });
            }

            function checkPrevNextButtons(currentPage, lastPage) {
                // hide prev button
                if (currentPage === 1) {
                    prevButton.addClass('hidden');
                }

                // hide next button
                if(currentPage === lastPage) {
                    nextButton.addClass('hidden');
                }
            }
        }
    }
})(jQuery);