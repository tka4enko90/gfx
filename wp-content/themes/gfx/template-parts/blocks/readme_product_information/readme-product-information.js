(function ($) {
    // copy function
    var copyBtn = $('.colours .colour');
    if(copyBtn.length) {
        copyBtn.on('click', function () {
            var self = $(this);
            var textToCopy = self.prev('.text-to-copy');

            if(textToCopy.length) {
                textToCopy.focus().select();
                document.execCommand('copy');
            }
        });
    }
})(jQuery);