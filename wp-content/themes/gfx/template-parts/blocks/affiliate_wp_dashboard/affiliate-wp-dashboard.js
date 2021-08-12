(function ($) {
    // init select2
    var select = $('select');
    if(select.length) {
        select.select2();
    }

    // copy function
    var copyBtn = $('.copy-btn');
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