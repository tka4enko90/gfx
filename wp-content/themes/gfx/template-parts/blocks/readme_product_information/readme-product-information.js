(function ($) {
    // copy function
    var copyBtn = $('.colours .colour');
    var successCopyPopup = $('.copied-popup');

    if(copyBtn.length) {
        copyBtn.on('click', function (e) {
            e.preventDefault();
            var self = $(this);
            var text = self.data('value');
            copyToClipboard(text);

            if (successCopyPopup.length) {
                var textBlock = successCopyPopup.find('.text')
                textBlock.text('Code copied to clipboard');
                successCopyPopup.fadeIn(150);

                // close popup after 3 seconds
                if (successCopyPopup.is(':visible')) {
                    setTimeout(function () {
                        successCopyPopup.fadeOut(200);
                    }, 3000);
                }
            }
        });
    }

    // copy to clipboard function
    function copyToClipboard(text) {
        var temp = $("<input>");
        $("body").append(temp);
        temp.val(text).select();
        document.execCommand("copy");
        temp.remove();
    }
})(jQuery);