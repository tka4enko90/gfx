function copyPromoCode(text) {
	let jsPromoCodeBtn = document.querySelector( '.js-promo-code-btn' ),
		oldText        = jsPromoCodeBtn.innerText,
		width          = jsPromoCodeBtn.offsetWidth,
		input          = document.createElement( 'input' );

	jsPromoCodeBtn.innerText   = 'Copied';
	jsPromoCodeBtn.style.width = width + 'px';

	const returnText = function () {
		jsPromoCodeBtn.innerText   = oldText;
		jsPromoCodeBtn.style.width = null;
		jsPromoCodeBtn.removeEventListener( 'mouseleave', returnText )
	}

	jsPromoCodeBtn.addEventListener( 'mouseleave', returnText )

	input.setAttribute( 'value', text );
	document.body.appendChild( input );
	input.select();
	let result = document.execCommand( 'copy' );
	document.body.removeChild( input );

	return result;
}
