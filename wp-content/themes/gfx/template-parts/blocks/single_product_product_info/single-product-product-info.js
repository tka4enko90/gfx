(function ($) {
    var singleProductGallerySlider = $('.single-product-gallery-slider'),
        singleProductGallerySliderNav = $('.single-product-gallery-slider-nav'),
        dropDownItem = $('.dropdown-item');

    if (singleProductGallerySlider.length) {
        singleProductGallerySlider.each(function () {
            $(this).slick({
                dots: false,
                arrows: false,
                infinite: true,
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
                infinite: true,
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
        var dropDownDescription = dropDownItem.find('.dropdown-description');

        dropDownTitle.on('click', function () {
            var self = $(this),
                currentDropDownDescription = self.parent().find('.dropdown-description');

            if(self.hasClass('opened')) {
                self.removeClass('opened');
                currentDropDownDescription.slideUp(200);
            } else {
                dropDownTitle.removeClass('opened');
                dropDownDescription.slideUp(200);

                if(currentDropDownDescription.length) {
                    self.addClass('opened');
                    currentDropDownDescription.slideDown(200);
                }
            }
        });
    }
})
(jQuery);