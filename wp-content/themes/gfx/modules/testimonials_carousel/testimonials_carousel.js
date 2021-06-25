(function ($) {
    $(document).on('ready', function () {
        var testimonialsCarousel = $('.testimonials-carousel-slider');
        if (testimonialsCarousel.length) {
            testimonialsCarousel.each(function () {
                $(this).slick({
                    dots: true,
                    arrows: false,
                    infinite: false,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 1140,
                            settings: {
                                slidesToShow: 2,
                            }
                        },
                        {
                            breakpoint: 769,
                            settings: {
                                slidesToShow: 1,
                            }
                        }
                    ]
                });
            });
        }
    });
})
(jQuery);