(function ($) {
    var categoriesList = $('.categories-list');
    if(categoriesList.length) {
        // make dropdown item white - if it has active child item
        $(document).on('ready', function () {
            var childrenItem = categoriesList.find('.has-children > ul > li > a');
            if(childrenItem.length) {
                childrenItem.each(function () {
                    var self = $(this);
                    if(self.hasClass('current')) {
                        var parentItem = self.closest('.has-children').find('a').first();
                        if(parentItem.length) {
                            parentItem.trigger('click');
                        }
                    }
                });
            }
        });

        // click on dropdown
        var hasChildrenItem = categoriesList.find('.has-children > a');
        if(hasChildrenItem.length) {
            hasChildrenItem.on('click', function () {
                var self = $(this);
                var dropDownList = self.next();

                if(dropDownList.length) {
                    self.toggleClass('opened');
                    dropDownList.slideToggle(200);
                }
            });
        }
    }
})(jQuery);