!function(e){var n=e(".contact-info");if(n.length){var t=n.find(".input-holder .element");t.length&&(t.on("keypress",(function(){var n=e(this).parent().next(".custom-placeholder");n.length&&n.hide()})),t.on("change",(function(){var n=e(this),t=n.parent().next(".custom-placeholder");t.length&&""===n.val().trim()&&t.show()})))}document.addEventListener("wpcf7mailsent",(function(n){console.log(n.detail);var t=e("body").find("form.sent");t.length&&(t.find(".custom-placeholder").length&&e(".custom-placeholder").show())}),!1)}(jQuery);