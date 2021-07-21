<?php
/**
 * @package WordPress
 * @subpackage gfx
 */
?>

<footer class="footer">
    <div class="main-block">
        <div class="container large">
            <div class="inner">
                <?php
                $logo_first = get_field('logo_first', 'option');
                $logo_second = get_field('logo_second', 'option'); ?>

                <?php if ($logo_first || $logo_second) : ?>
                    <div class="logo-holder">
                        <a href="<?php echo home_url(); ?>">
                            <?php if ($logo_first) : ?><span><?php echo $logo_first; ?></span><?php endif; ?>
                            <?php if ($logo_first) : ?><span
                                    class="red"><?php echo $logo_second; ?></span><?php endif; ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (has_nav_menu('footer_menu')) : ?>
                    <div class="menu-holder">
                        <?php wp_nav_menu(['theme_location' => 'footer_menu', 'container' => '']); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="copyrights-block">
        <div class="container large">
            <?php $footer_copyright_text = get_field('footer_copyright_text', 'option');
            if ($footer_copyright_text) : ?>
                <div class="copyright-text">
                    <?php echo $footer_copyright_text; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>
</div><!-- .wrapper -->
<div class="product-pop-out">
    <div class="popup">
        <div class="top-holder">
            <button class="product-pop-out-close-btn">
                <img src="<?php echo get_template_directory_uri() ?>/static/img/close-btn-icon.svg"
                     alt="close icon">
            </button>

            <div class="buttons-holder">
                <a href="" class="primary-button small add_to_cart_button ajax_add_to_cart " rel="nofollow"
                   data-quantity="1" data-product_id="" data-product_title="" data-product_sku=""></a>
                <a href="" class="secondary-button small more-info-link">More Info</a>
            </div>
        </div>

        <div class="info-holder">
            <div class="holder">
                <div>
                    <h4 class="product-title"></h4>
                    <div class="product-category"></div>
                </div>
                <div class="compatible-with">
                </div>
            </div>
            <div class="previews-holder"></div>
        </div>
    </div>
</div>
<?php wp_footer() ?>
</body>
</html>
