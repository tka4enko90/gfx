(function ($) {
    'use strict';
    var body = $('body');

    //Check Mobile Devices
    var checkTouchDevice = function () {
        var isTouch = ('ontouchstart' in document.documentElement);
        if (isTouch) {
            $('body').addClass('touch');
        } else {
            $('body').addClass('no-touch');
        }
    };
    checkTouchDevice();

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

    if (hasChildrenListItem.length) {
        if ($(window).width() > 960 && $('body').hasClass('no-touch')) {
            hasChildrenListItem.hover(function () {
                var self = $(this);

                var subMenu = self.find('a:first').next('.sub-menu');
                var subMenus = $('.header .menu > li.menu-item-has-children > .sub-menu');

                if (subMenus.length) {
                    subMenus.fadeOut(100);
                    hasChildrenListItem.removeClass('active');

                    if (!subMenu.is(':visible')) {
                        self.addClass('active');
                        subMenu.fadeIn(200).css('display', 'flex');
                    }
                }
            });
        } else if ($(window).width() > 960 && $('body').hasClass('touch') && hasChildrenLink.length) {
            hasChildrenLink.on('click', function (e) {
                e.preventDefault();

                var self = $(this);

                var subMenu = self.next('.sub-menu');
                var subMenus = $('.header .menu > li.menu-item-has-children > .sub-menu');

                if (subMenus.length) {
                    subMenus.fadeOut(100);
                    hasChildrenLink.removeClass('active');

                    if (!subMenu.is(':visible')) {
                        self.addClass('active');
                        subMenu.fadeIn(200).css('display', 'flex');
                    }
                }
            });
        } else {
            hasChildrenListItem.on('click', function () {
                var self = $(this);

                var link = self.find('a:first');
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

    $(window).on('orientationchange', function() {
        var menu = $('.header .menu-holder');

        if(menu.length) {
            menu.css('display', '');
        }
    });

    // show added to cart popup
    var addedToCartPopup = $('.product-added-to-cart-popup');
    if (body.length) {
        body.on('added_to_cart', function (event, fragments, cart_hash, button) {
            var addedProductName = button.attr('data-product_title');
            var productPopOutCloseBtn = $('.product-pop-out-close-btn');
            var cartLink = $('.header li.cart');

            if(cartLink.length) {
                cartLink.addClass('not-empty');
            }

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

    // AJAX Table pagination
    function ajaxPagination(pagination, table, template) {
        var paginationButton = pagination.find('button');

        if (paginationButton.length) {
            var prevButton = pagination.find('button.prev');
            var nextButton = pagination.find('button.next');

            paginationButton.on('click', function () {
                var self = $(this);

                var items = pagination.attr('data-items');
                var itemsPerPage = pagination.attr('data-items-per-page');
                var currentPage = parseInt(pagination.attr('data-current-page'));
                var lastPage = parseInt(pagination.attr('data-last-page'));
                var offset = 0;

                prevButton.removeClass('hidden');
                nextButton.removeClass('hidden');

                // prev btn
                if (self.hasClass('prev')) {
                    var prevPage = currentPage - 1;

                    offset = (prevPage * itemsPerPage) - itemsPerPage;
                    changeActivePage(pagination, prevPage);
                }
                // next btn
                else if (self.hasClass('next')) {
                    var nextPage = currentPage + 1

                    offset = (nextPage * itemsPerPage) - itemsPerPage;
                    changeActivePage(pagination, nextPage);
                }
                // page number
                else {
                    var pageNum = parseInt(self.text());
                    offset = (pageNum * itemsPerPage) - itemsPerPage;

                    pagination.attr('data-current-page', pageNum);

                    paginationButton.removeClass('current');
                    self.addClass('current');
                }

                currentPage = parseInt(pagination.attr('data-current-page'));
                checkPrevNextButtons(currentPage, lastPage, prevButton, nextButton);

                $.ajax({
                    url: ajaxurl.url,
                    type: 'POST',
                    data: {
                        action: 'my_account_table_ajax_pagination',
                        items: items,
                        offset: offset,
                        itemsPerPage: itemsPerPage,
                        template: template
                    },
                    success: function (data) {
                        if (data.content && table.length) {
                            table.html(data.content);
                        }
                    }
                });
            });
        }
    }

    function changeActivePage(pagination, currentPage) {
        pagination.attr('data-current-page', currentPage);

        var paginationPageNumber = pagination.find('button.page-number');
        paginationPageNumber.removeClass('current');

        // find and set current class for page
        paginationPageNumber.each(function () {
            var self = $(this);
            var page = parseInt(self.text());

            if (page == currentPage) {
                self.addClass('current');
            }
        });
    }

    function checkPrevNextButtons(currentPage, lastPage, prevButton, nextButton) {
        // hide prev button
        if (currentPage === 1) {
            prevButton.addClass('hidden');
        }

        // hide next button
        if (currentPage === lastPage) {
            nextButton.addClass('hidden');
        }
    }

    // My account downloads table pagination
    var downloadsTable = $('.downloads-ajax-table');
    var downloadsPagination = $('.my-account-downloads-pagination');
    var downloadsTableTemplate = 'woocommerce/order/order-downloads-table';

    if (downloadsPagination.length && downloadsTable.length && downloadsTableTemplate) {
        ajaxPagination(downloadsPagination, downloadsTable, downloadsTableTemplate);
    }

    // My account orders table pagination
    var ordersTable = $('.orders-ajax-table');
    var ordersPagination = $('.my-account-orders-pagination');
    var ordersTableTemplate = 'woocommerce/order/orders-table';

    if (ordersPagination.length && ordersTable.length && ordersTableTemplate) {
        ajaxPagination(ordersPagination, ordersTable, ordersTableTemplate);
    }

})(jQuery);