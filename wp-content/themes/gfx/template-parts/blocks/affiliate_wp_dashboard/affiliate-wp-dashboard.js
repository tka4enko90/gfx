(function ($) {
    // init select2
    var select = $('select');
    if(select.length) {
        select.select2();
    }

    // copy function
    var copyBtn = $('.copy-btn');
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