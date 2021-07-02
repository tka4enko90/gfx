(function ($) {
    // custom placeholder
    var section = $('.contact-info');
    if (section.length) {
        var element = section.find('.input-holder .element');
        if (element.length) {
            element.on('keypress', function () {
                var self = $(this);
                var placeholder = self.parent().next('.custom-placeholder');

                if (placeholder.length) {
                    placeholder.hide();
                }
            });
            element.on('change', function () {
                var self = $(this);
                var placeholder = self.parent().next('.custom-placeholder');

                if (placeholder.length) {
                    if (self.val().trim() === '') {
                        placeholder.show();
                    }
                }
            });
        }
    }

    document.addEventListener( 'wpcf7mailsent', function( event ) {
        var form = $('body').find('form.sent');
        if(form.length) {
            var placeholder = form.find('.custom-placeholder');

            if(placeholder.length) {
                $('.custom-placeholder').show();
            }
        }
    }, false );
})
(jQuery);