(function ($) {
	let $thanksPopup          = $( '.js-thanks-popup' ),
		$thanksPopupOverlay   = $( '.js-thanks-popup-overlay' ),
		$downloadSomeLinksBtn = $( '.js-download-some-links-btn' ),
		$thanksPopupRepeatBtn = $( '.js-thanks-popup-repeat-btn' ),
		$closeBtn             = $( '.js-close-btn' );

	function popupToggle() {
		$thanksPopup.toggleClass( 'show' );
	}

	function downloadAll(event) {
		setTimeout(function() { 
			let linksArr = event.target.dataset.links.slice( 0,-1 ).split( "," ),
				link     = document.createElement( 'a' );

			link.style.display = 'none';

			document.body.appendChild( link );

			for (let i = 0; i < linksArr.length; i++) {
				link.setAttribute( 'href', linksArr[i] );
				link.setAttribute( 'download', linksArr[i].split( '/' ).pop() );

				link.click();
			}

			document.body.removeChild( link );

		}, 3000);

	}

	if ($thanksPopup.length && $downloadSomeLinksBtn.length) {
		$closeBtn.click( popupToggle );
		$thanksPopupOverlay.click( popupToggle );
		$thanksPopupRepeatBtn.click( downloadAll );
		$downloadSomeLinksBtn.click(
			function () {
				popupToggle();
				downloadAll( event );
			}
		);
	}
})( jQuery );
