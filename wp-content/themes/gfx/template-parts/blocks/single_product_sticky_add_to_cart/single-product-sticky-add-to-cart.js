(function ($) {
	let stickyAddToCart = $( '.js-single-product-sticky-add-to-cart' ),
		whatsInside     = $( '.js-whats-inside' );

	if (stickyAddToCart.length && whatsInside.length) {
		$( window ).scroll(
			function() {
				let scrollTop = $( window ).scrollTop();
				if ( scrollTop >= whatsInside.offset().top - 90) {
					stickyAddToCart.addClass( 'sticky' )
				} else {
					stickyAddToCart.removeClass( 'sticky' )
				}
			}
		);
	}
})( jQuery );
