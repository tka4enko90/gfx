(function ($) {
    $(document).on('ready', function () {
        var testimonialsCarousel = $('.products-carousel');
        if (testimonialsCarousel.length) {
            testimonialsCarousel.each(function () {
                $(this).slick({
                    dots: true,
                    arrows: false,
                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    speed: 1000,
                    slidesToShow: 4,
                    slidesToScroll: 4,

                    responsive: [
                        {
                            breakpoint: 1140,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
                            }
                        },
                    ]
                });
            });
        }
    });
})
(jQuery);