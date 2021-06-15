(function($){
    'use strict';

    // add sticky class for header after scroll
	$(window).on('scroll', function () {
		var scrollTop = $(document).scrollTop();
		if(scrollTop > 20 ){
			$('.header').addClass('sticky');
		} else {
			$('.header').removeClass('sticky');
		}
	});

    // preventDefault for not a link link menu
    $('.not-a-link > a').on('click', function (e) {
		e.preventDefault();
	});

    // show submenu on click
	$('.header li.menu-item-has-children > a').on('click', function (e) {
		e.preventDefault();

		var subMenu = $(this).next('.sub-menu');
		var subMenus = $('.header .menu > li.menu-item-has-children > .sub-menu');
		var links = $('.header li.menu-item-has-children > a');
		var listItems = $('.header li.menu-item-has-children');

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

	// close sub-menu on click not in sub-menus area
	$(document).mouseup(function (e){
		if($(window).width() > 960) {
			var div = $('.header .menu-holder > ul > li.menu-item-has-children > a').next('.sub-menu');
			if (!div.is(e.target)
				&& div.has(e.target).length === 0) {
				div.fadeOut(100);
			}
		}
	});

	// show mobile menu on click
	$('.header .burger-btn').on('click', function () {
		var menu = $('.header .menu-holder');

		if(menu.is(':visible')) {
			$('body').css('overflow', 'auto');
		} else {
			$('body').css('overflow', 'hidden');
		}

		$(this).toggleClass('active');
		menu.slideToggle(200);
	});

	$(function() {
		objectFitImages('img');
	});
})(jQuery);