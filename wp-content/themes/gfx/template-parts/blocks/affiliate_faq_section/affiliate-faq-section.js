(function ($) {
    var faq = $('.faq-dropdown');

    if (faq.length) {
        var faqQuestion = faq.find('.question');
        if (faqQuestion.length) {
            faqQuestion.on('click', function () {
                var self = $(this);
                var parentFaq = $(this).parent();
                var answer = parentFaq.find('.answer');

                if (answer.length) {
                    answer.slideToggle(150);
                }
            });
        }
    }
})(jQuery);