(function ($) {
    var singleProductGallerySlider = $('.single-product-gallery-slider'),
        singleProductGallerySliderNav = $('.single-product-gallery-slider-nav'),
        dropDownItem = $('.dropdown-item');

    if (singleProductGallerySlider.length) {
        singleProductGallerySlider.each(function () {
            $(this).slick({
                dots: false,
                arrows: false,
                infinite: false,
                fade: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                asNavFor: '.single-product-gallery-slider-nav'
            });
        });
    }
    if (singleProductGallerySliderNav.length) {
        singleProductGallerySliderNav.each(function () {
            $(this).slick({
                dots: false,
                arrows: true,
                prevArrow: "<button class='slick-prev'></button>",
                nextArrow: "<button class='slick-next'></button>",
                infinite: false,
                slidesToShow: 3,
                slidesToScroll: 1,
                focusOnSelect: true,
                asNavFor: '.single-product-gallery-slider',
                responsive: [
                    {
                        breakpoint: 540,
                        settings: {
                            slidesToShow: 2,
                        }
                    }
                ]
            });
        });
    }
    if (dropDownItem.length) {
        var dropDownTitle = dropDownItem.find('.dropdown-title');

        dropDownTitle.on('click', function () {
            var self = $(this),
                dropDownDescription = self.parent().find('.dropdown-description');

            if(dropDownDescription.length) {
                self.toggleClass('opened');
                dropDownDescription.slideToggle(200);
            }
        });
    }

    // var addToCartBtn = $('.single-ajax-add-to-cart-btn');
    // if(addToCartBtn.length) {
    //     addToCartBtn.on('click', function (e) {
    //         e.preventDefault();
    //     });
    // }
})
(jQuery);