!function(e){var t=e("body"),i=e(".header"),r=e(".product-card-open-pop-out");r.length&&r.on("click",(function(){var r=e(this).closest(".products-grid-with-pop-out").find(".product-pop-out"),d=JSON.parse(e(this).attr("data-product-pop-out")),o=r.find(".product-trailer-video-holder"),n=r.find(".buttons-holder"),a=n.find("a.add_to_cart_button"),l=n.find("a.more-info-link"),p=r.find(".product-title"),c=r.find(".product-category"),s=r.find(".compatible-with"),v=r.find(".previews-holder");if(function(e){var t=e.find(".product-trailer-video-holder"),i=e.find(".previews-holder"),r=e.find("a.add_to_cart_button"),d=e.find("a.more-info-link"),o=e.find(".product-title"),n=e.find(".product-category"),a=e.find(".buttons-holder"),l=e.find(".compatible-with");t.remove(),a.removeClass("product-trailer-visible"),i.html(""),r.attr("href","").attr("data-product_id","").attr("data-product_sku","").html(""),d.attr("href",""),o.text(""),n.text(""),l.html("")}(r),d&&!r.is(":visible")){d.product_trailer&&(n.length&&(e(window).width(),n.before('<div class="product-trailer product-trailer-video-holder"><video playsinline autoPlay="true" loop="true" muted="true">\n                <source src="'+d.product_trailer.url+'" type="'+d.product_trailer.mime_type+'">\n            </video></div>')),o.find("video").load(),n.addClass("product-trailer-visible")),d.product_price&&a.length&&d.product_add_to_cart_url&&d.product_id&&d.product_title&&(a.attr("href",d.product_add_to_cart_url),a.attr("data-product_id",d.product_id),a.attr("data-product_title",d.product_title),a.html("Add to cart - "+d.product_price),d.product_sku&&a.attr("data-product_sku",d.product_sku)),d.product_permalink&&l.length&&l.attr("href",d.product_permalink),d.product_title&&p.length&&p.text(d.product_title),d.product_category&&c.length&&c.text(d.product_category),d.compatible_with&&s.length&&(s.append('<div class="title">Compatible With</div>'),e(d.compatible_with).each((function(e){var t=d.compatible_with[e].icon,i=d.compatible_with[e].name;0===e?s.append('<div class="items"><div class="item">\n                        <img src="'+t+'" alt="">\n<span class="name">'+i+"</span>\n                    </div></div>"):s.find(".items").append('<div class="item">\n                        <img src="'+t+'" alt="">\n<span class="name">'+i+"</span>\n                    </div>")}))),d.assets_preview&&v.length&&(v.append('<div class="preview assets-preview">\n                            <div class="preview-name">Assets Preview:</div>\n                            <div class="video-holder">\n                                <video class="pop-out-video" >\n                                    <source src="'+d.assets_preview.url+'"\n                                            >\n                                </video>\n                            </div>\n                        </div>'),v.find(".assets-preview video")[0].load()),d.alert_preview&&v.length&&(v.append('<div class="preview alert-preview">\n                            <div class="preview-name">Alert Preview:</div>\n                            <div class="video-holder">\n                                <video class="pop-out-video">\n                                    <source src="'+d.alert_preview.url+'">\n                                </video>\n                            </div>\n                        </div>'),v.find(".alert-preview video")[0].load()),d.screen_preview&&v.length&&(v.append('<div class="preview screen-preview">\n                            <div class="preview-name">Screen Preview:</div>\n                            <div class="video-holder">\n                                <video class="pop-out-video" loop="true" muted="true" playsinline>\n                                    <source src="'+d.screen_preview.url+'"\n                                            type="'+d.screen_preview.mime_type+'">\n                                </video>\n                            </div>\n                        </div>'),v.find(".screen-preview video")[0].load());var u=window.innerWidth-t.width();u&&i.length&&t.length&&r.length&&(i.css("width","calc(100% - "+u+"px)"),t.css("width","calc(100% - "+u+"px)"),t.css("overflow","hidden"),r.fadeIn(200).css("display","flex"))}}));var d=e(".product-pop-out-close-btn");d.length&&d.on("click",(function(){var r=e(this).closest(".product-pop-out");r.length&&(r.fadeOut(200),setTimeout((function(){i.length&&t.length&&(i.css("width","100%"),t.css("width","100%"),t.css("overflow","auto"))}),200))}));var o=e(".previews-holder");o.length&&o.on("click",".pop-out-video",(function(){var t=e(".product-trailer-video-holder"),i=e(this).clone().prop("autoplay",!0).attr("playsinline","");t.length&&i.length&&(t.find("video").remove(),t.append(i))}))}(jQuery);