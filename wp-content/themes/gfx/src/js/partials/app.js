(function($){
    'use strict';

    // preventDefault for not a link link menu
    $('.not-a-link > a').on('click', function (e) {
		e.preventDefault();
	});

    // show submenu on hover
	$('li.menu-item-has-children > a').on('click', function (e) {
		e.preventDefault();

		var subMenu = $(this).next('.sub-menu');
		var subMenus = $('.menu > li.menu-item-has-children > .sub-menu');

		subMenus.fadeOut(100);

		if(subMenu.is(':visible')) {
			subMenu.fadeOut(100);
		} else {
			subMenu.fadeIn(200).css('display', 'flex');
		}
	});

	$(function() {
		objectFitImages('img');
	});
})(jQuery);