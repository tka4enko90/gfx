!function(e){var i=e(".product-card-open-pop-out");i.length&&i.on("click",(function(){var i=e(this).closest(".products-grid-with-pop-out").find(".product-pop-out"),t=JSON.parse(e(this).attr("data-productPopOut")),r=i.find(".product-trailer-video-holder"),d=i.find(".buttons-holder"),o=d.find("a.add-to-cart-link"),n=d.find("a.more-info-link"),a=i.find(".product-title"),l=i.find(".product-category"),p=i.find(".compatible-with"),s=i.find(".previews-holder");!function(e){var i=e.find(".product-trailer-video-holder"),t=e.find(".previews-holder"),r=e.find("a.add-to-cart-link"),d=e.find("a.more-info-link"),o=e.find(".product-title"),n=e.find(".product-category"),a=e.find(".buttons-holder"),l=e.find(".compatible-with");i.remove(),a.removeClass("product-trailer-visible"),t.html(""),r.attr("href","").html(""),d.attr("href",""),o.text(""),n.text(""),l.html("")}(i),t&&(i.is(":visible")||(t.product_trailer&&(d.length&&(e(window).width(),d.before('<div class="product-trailer product-trailer-video-holder"><video playsinline autoPlay="true" loop="true" muted="true">\n                <source src="'+t.product_trailer.url+'" type="'+t.product_trailer.mime_type+'">\n            </video></div>')),r.find("video").load(),d.addClass("product-trailer-visible")),t.product_price&&o.length&&t.product_add_to_cart_url&&(o.attr("href",t.product_add_to_cart_url),o.html("Add to cart - "+t.product_price)),t.product_permalink&&n.length&&n.attr("href",t.product_permalink),t.product_title&&a.length&&a.text(t.product_title),t.product_category&&l.length&&l.text(t.product_category),t.compatible_with&&p.length&&(p.append('<div class="title">Compatible With</div>'),e(t.compatible_with).each((function(e){var i=t.compatible_with[e].icon,r=t.compatible_with[e].name;0===e?p.append('<div class="items"><div class="item">\n                        <img src="'+i+'" alt="">\n<span class="name">'+r+"</span>\n                    </div></div>"):p.find(".items").append('<div class="item">\n                        <img src="'+i+'" alt="">\n<span class="name">'+r+"</span>\n                    </div>")}))),t.assets_preview&&s.length&&(s.append('<div class="preview assets-preview">\n                            <div class="preview-name">Assets Preview:</div>\n                            <div class="video-holder">\n                                <video class="pop-out-video" >\n                                    <source src="'+t.assets_preview.url+'"\n                                            >\n                                </video>\n                            </div>\n                        </div>'),s.find(".assets-preview video")[0].load()),t.alert_preview&&s.length&&(s.append('<div class="preview alert-preview">\n                            <div class="preview-name">Alert Preview:</div>\n                            <div class="video-holder">\n                                <video class="pop-out-video">\n                                    <source src="'+t.alert_preview.url+'">\n                                </video>\n                            </div>\n                        </div>'),s.find(".alert-preview video")[0].load()),t.screen_preview&&s.length&&(s.append('<div class="preview screen-preview">\n                            <div class="preview-name">Screen Preview:</div>\n                            <div class="video-holder">\n                                <video class="pop-out-video" loop="true" muted="true" playsinline>\n                                    <source src="'+t.screen_preview.url+'"\n                                            type="'+t.screen_preview.mime_type+'">\n                                </video>\n                            </div>\n                        </div>'),s.find(".screen-preview video")[0].load()),e("body").css("overflow","hidden"),i.fadeIn(200).css("display","flex")))}));var t=e(".product-pop-out-close-btn");t.length&&t.on("click",(function(){var i=e(this).closest(".product-pop-out");e("body").css("overflow","auto"),i.fadeOut(200)}));var r=e(".previews-holder");r.length&&r.on("click",".pop-out-video",(function(){var i=e(".product-trailer-video-holder"),t=e(this).clone().prop("autoplay",!0).attr("playsinline","");i.find("video").remove(),i.append(t)}))}(jQuery);