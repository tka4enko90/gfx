(function ($) {
    var parentSection = $('.shop-products-grid');
    var filtrationForm = $('#product-filtration-form');
    var filterTagsSelect = $('.filter-tags-select');
    var filterBubbles = $('.filter-bubbles');
    var categoriesList = $('.categories-list');
    var allPostsCount = filtrationForm.find('.all-posts-count');
    var showingPostsCount = filtrationForm.find('.showing-posts-count');
    var colorCheckbox = $('.colors-holder input[type="checkbox"]');

    if (categoriesList.length) {
        // make dropdown item white - if it has active child item
        $(document).on('ready', function () {
            var childrenItem = categoriesList.find('.has-children > ul > li > a');
            if (childrenItem.length) {
                childrenItem.each(function () {
                    var self = $(this);
                    if (self.hasClass('current')) {
                        var parentItem = self.closest('.has-children').find('a').first();
                        if (parentItem.length) {
                            parentItem.trigger('click');
                        }
                    }
                });
            }
        });

        // click on dropdown
        var hasChildrenItem = categoriesList.find('.has-children > a');
        if (hasChildrenItem.length) {
            hasChildrenItem.on('click', function () {
                var self = $(this);
                var dropDownList = self.next();

                if (dropDownList.length) {
                    self.toggleClass('opened');
                    dropDownList.slideToggle(200);
                }
            });
        }
    }

    // init select2
    $(document).ready(function () {
        var sortBySelect = $('.custom-select.sort-by-select');
        var customSelectMultiple = $('.custom-select.multiple');

        if (sortBySelect.length) {
            sortBySelect.select2({
                placeholder: "Sort By",
                minimumResultsForSearch: -1,
            });
        }

        if (customSelectMultiple.length) {
            customSelectMultiple.select2({
                multiple: true,
                minimumResultsForSearch: -1,
            });

            customSelectMultiple.find('option').prop("selected", false);
            customSelectMultiple.trigger('change.select2');
        }
    });

    // add filter bubbles
    if (filterTagsSelect.length || colorCheckbox.length) {
        var filterBubbles = $('.filter-bubbles');

        if (filterTagsSelect.length) {
            // on select value event
            filterTagsSelect.on('select2:select', function (e) {
                var selectedValueId = e.params.data.id;
                var selectedValueText = e.params.data.text;

                if (selectedValueId.length && selectedValueText.length) {
                    addBubble('filter', selectedValueText, selectedValueId);
                }
            });

            // on unselect value event
            filterTagsSelect.on('select2:unselect', function (e) {
                var selectedValue = e.params.data.id;
                removeBubble('filter', selectedValue);
            });
        }

        if (colorCheckbox.length) {
            colorCheckbox.on('change', function (e) {
                var self = $(this);
                var selectedValue = self.val();

                if (self.is(':checked')) {
                    if (selectedValue) {
                        addBubble('color', selectedValue);
                    }
                } else {
                    removeBubble('color', selectedValue);
                }
            });
        }

        function addBubble(type, value, dataId = '') {
            if (type == 'filter') {
                var bubble = '<div class="bubble" data-id="' + dataId + '"><span>' + value + '\n</span>' +
                    '                        <button class="delete-bubble">\n' +
                    '                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"\n' +
                    '                                 version="1.1" width="512" height="512" x="0"\n' +
                    '                                 y="0" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512 512"\n' +
                    '                                 xml:space="preserve" class="">\n' +
                    '                                    <path d="m512.001 84.853-84.853-84.853-171.147 171.147-171.148-171.147-84.853 84.853 171.148 171.147-171.148 171.148 84.853 84.853 171.148-171.147 171.147 171.147 84.853-84.853-171.148-171.148z"\n' +
                    '                                          fill="#ffffff" data-original="#000000" style="" class=""/>\n' +
                    '                                </svg>\n' +
                    '                        </button>\n' +
                    '                    </div>';
            } else {
                var bubble = '<div class="bubble" data-color="' + value + '"><span>' + value + '\n</span>' +
                    '                        <button class="delete-bubble">\n' +
                    '                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"\n' +
                    '                                 version="1.1" width="512" height="512" x="0"\n' +
                    '                                 y="0" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512 512"\n' +
                    '                                 xml:space="preserve" class="">\n' +
                    '                                    <path d="m512.001 84.853-84.853-84.853-171.147 171.147-171.148-171.147-84.853 84.853 171.148 171.147-171.148 171.148 84.853 84.853 171.148-171.147 171.147 171.147 84.853-84.853-171.148-171.148z"\n' +
                    '                                          fill="#ffffff" data-original="#000000" style="" class=""/>\n' +
                    '                                </svg>\n' +
                    '                        </button>\n' +
                    '                    </div>';
            }

            var clearAllButton = '<button class="clear-all-filters secondary-button extra-small grey">Clear All</button>';

            if (filterBubbles.length) {
                // if no bubbles added
                if (!filterBubbles.has('div.bubble').length) {
                    filterBubbles.append(bubble);
                    filterBubbles.append(clearAllButton);
                } else {
                    $(bubble).insertBefore('.clear-all-filters');
                }
            }
        }

        function removeBubble(type, value) {
            if (type && value) {
                if (type == 'filter') {
                    var unselectedBubble = 'div.bubble[data-id="' + value + '"]';

                    if (filterBubbles.length && unselectedBubble.length) {
                        filterBubbles.find(unselectedBubble).find('button.delete-bubble').trigger('click');
                    }
                } else {
                    var unselectedBubble = 'div.bubble[data-color="' + value + '"]';

                    if (filterBubbles.length && unselectedBubble.length) {
                        filterBubbles.find(unselectedBubble).find('button.delete-bubble').trigger('click');
                    }
                }
            }
        }
    }

    if (filterBubbles.length) {
        // delete-bubble button click
        filterBubbles.on('click', 'button.delete-bubble', function () {
            var self = $(this);
            var bubble = self.closest('.bubble');
            var bubbleId = bubble.data('id');
            var bubbleColorName = bubble.data('color');

            if (bubble.length) {
                var bubblesCount = filterBubbles.find('.bubble').length;

                if (bubblesCount === 1) {
                    filterBubbles.find('button.clear-all-filters').trigger('click');
                } else {
                    bubble.remove();

                    if (filterTagsSelect.length && bubbleId) {
                        var removeOption = filterTagsSelect.find('option[value="' + bubbleId + '"]');

                        if (removeOption.length) {
                            removeOption.prop('selected', false);
                            filterTagsSelect.trigger('change.select2');
                        }
                    }

                    if (colorCheckbox.length && bubbleColorName) {
                        var removeOption = $('input[value="' + bubbleColorName + '"]');

                        if (removeOption.length) {
                            removeOption.prop('checked', false);
                        }
                    }

                    filtrationForm.trigger('submit');
                }
            }
        });

        // clear all filters btn click
        filterBubbles.on('click', 'button.clear-all-filters', function () {
            filterBubbles.empty();

            // clear selected filters
            if (filterTagsSelect.length) {
                filterTagsSelect.find('option').prop("selected", false);
                filterTagsSelect.trigger('change.select2');
            }

            // clear selected colors
            if (colorCheckbox.length) {
                colorCheckbox.prop("checked", false);
            }

            filtrationForm.trigger('submit');
        });
    }

    if (filtrationForm.length) {
        filtrationForm.on('change', function () {
            filtrationForm.trigger('submit');
        });

        filtrationForm.on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: window.location.href,
                type: 'GET',
                headers: {
                    'x-filter-product': true
                },
                data: {
                    action: 'product_form_filters',
                    form: filtrationForm.serialize()
                },
                success: function (data) {
                    var ajaxContent = parentSection.find('.ajax-content');

                    if (ajaxContent.length && data) {
                        ajaxContent.html(data);

                        changeShowingInfo($(data));
                    }
                }
            });
        });
    }

    $(document).ready(function () {
        var ajaxContent = filtrationForm.find('.ajax-content');
        if (ajaxContent.length) {
            changeShowingInfo(ajaxContent);
        }
    });

    // change showing posts info
    function changeShowingInfo(block) {
        var showing = block.data('posts-count');
        var resultsCount = block.data('all-posts-count');

        if (allPostsCount.length && showingPostsCount.length) {
            showingPostsCount.html(showing);
            allPostsCount.html(resultsCount);
        }
    }
})(jQuery);