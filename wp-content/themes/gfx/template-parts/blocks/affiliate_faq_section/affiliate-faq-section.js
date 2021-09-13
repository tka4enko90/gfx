(function ($) {
    var faq = $('.faq-dropdown');

    if (faq.length) {
        var faqQuestion = faq.find('.question');
        var faqAnswer = faq.find('.answer');

        if (faqQuestion.length && faqAnswer.length) {
            faqQuestion.on('click', function () {
                var self = $(this);
                var currentAnswer = self.parent().find('.answer');

                if (currentAnswer.length) {
                    if (currentAnswer.is(':visible')) {
                        currentAnswer.slideUp(150);
                    } else {
                        faqAnswer.slideUp(150);
                        currentAnswer.slideDown(150);
                    }
                }
            });
        }
    }
})(jQuery);