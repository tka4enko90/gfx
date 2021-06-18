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
<?php wp_footer() ?>
</div><!-- .wrapper -->
</body>
</html>
