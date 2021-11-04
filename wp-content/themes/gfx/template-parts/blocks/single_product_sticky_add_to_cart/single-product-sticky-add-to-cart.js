(function ($) {
	let stickyAddToCart = $( '.js_single_product_sticky_add_to_cart' ),
		productInfo     = $( '.js_single_product_product_info' );

	if (stickyAddToCart.length && productInfo.length) {
		$( window ).scroll(
			function() {
				let scrollTop = $( window ).scrollTop();
				if ( scrollTop >= productInfo.offset().top + productInfo.outerHeight() - 90) {
					stickyAddToCart.addClass( 'sticky' )
				} else {
					stickyAddToCart.removeClass( 'sticky' )
				}
			}
		);
	}
})( jQuery );
