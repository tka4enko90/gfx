(function ($) {
    // custom placeholder
    var section = $('.contact-info');
    if (section.length) {
        var element = section.find('.input-holder .element');
        if (element.length) {
            element.bind('cut', function() {
                var self = $(this);
                var placeholder = self.parent().next('.custom-placeholder');

                if (placeholder.length) {
                    placeholderCheck(self, placeholder);
                }
            });

            element.on('keydown keyup change', function (e) {
                var self = $(this);
                var placeholder = self.parent().next('.custom-placeholder');

                if (placeholder.length) {
                    placeholderCheck(self, placeholder);
                }
            });

            function placeholderCheck(self, placeholder) {
                if (self.val().trim() === '') {
                    placeholder.show();
                } else {
                    placeholder.hide();
                }
            }
        }
    }

    document.addEventListener( 'wpcf7mailsent', function( event ) {
        var form = $('body').find('form.sent');
        if(form.length) {
            var placeholder = form.find('.custom-placeholder');

            if(placeholder.length) {
                placeholder.show();
            }
        }
    }, false );
})
(jQuery);