!function(t){hljs.highlightAll(),hljs.initLineNumbersOnLoad();var e=t(".readme-product-settings .tab-name"),a=t(".readme-product-settings .tab-content");e.length&&a.length&&(e.first().addClass("active"),a.first().addClass("active"),e.on("click",(function(){var n=t(this);if(!n.hasClass("active")){e.removeClass("active"),n.addClass("active");var i=n.data("type"),s=t('.readme-product-settings .tab-content[data-type="'+i+'"]');s.length&&(a.hide(),s.fadeIn(100))}})));var n=t(".copy-code-btn");n.length&&n.on("click",(function(e){e.preventDefault(),function(e){var a=t("<input>");t("body").append(a),a.val(e).select(),document.execCommand("copy"),a.remove()}(t(this).data("value"))}))}(jQuery);