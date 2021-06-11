(function($){
    'use strict';

    // preventDefault for not a link link menu
    $('.not-a-link > a').on('click', function (e) {
		e.preventDefault();
	});

    // show submenu on click
	$('li.menu-item-has-children > a').on('click', function (e) {
		e.preventDefault();

		var subMenu = $(this).next('.sub-menu');
		var subMenus = $('.menu > li.menu-item-has-children > .sub-menu');
		var links = $('li.menu-item-has-children > a');
		var listItems = $('li.menu-item-has-children');

		if($(window).width() > 960) {
			subMenus.fadeOut(100);
			links.removeClass('active');

			if(!subMenu.is(':visible')) {
				$(this).addClass('active');
				subMenu.fadeIn(200).css('display', 'flex');
			}
		} else {
			subMenus.slideUp(200);
			listItems.removeClass('active');

			if(!subMenu.is(':visible')) {
				$(this).closest('li.menu-item-has-children').addClass('active');
				subMenu.slideDown(200).css('display', 'flex');
			}
		}
	});

	// show mobile menu on click
	$('.header .burger-btn').on('click', function () {
		$('.header .menu-holder').slideToggle(200);
	});

	$(function() {
		objectFitImages('img');
	});
})(jQuery);