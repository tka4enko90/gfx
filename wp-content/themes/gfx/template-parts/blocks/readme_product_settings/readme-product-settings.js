(function ($) {
    hljs.highlightAll();
    hljs.initLineNumbersOnLoad();

    var tabName = $('.readme-product-settings .tab-name');
    var tabContent = $('.readme-product-settings .tab-content');
    if (tabName.length && tabContent.length) {
        tabName.first().addClass('active');
        tabContent.first().addClass('active');

        tabName.on('click', function () {
            var self = $(this);
            if (!self.hasClass('active')) {
                tabName.removeClass('active');
                self.addClass('active');

                var tabType = self.data('type');
                var newTabContent = $('.readme-product-settings .tab-content[data-type="' + tabType + '"]');

                if (newTabContent.length) {
                    tabContent.hide();
                    newTabContent.fadeIn(100);
                }
            }
        });
    }

    // copy function
    var copyBtn = $('.copy-code-btn');
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