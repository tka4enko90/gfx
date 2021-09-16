(function ($) {
    // copy function
    var copyBtn = $('.colours .colour');
    if(copyBtn.length) {
        copyBtn.on('click', function (e) {
            e.preventDefault();
            var self = $(this);
            var text = self.data('value');
            copyToClipboard(text);
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