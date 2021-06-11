<?php
/**
 * @package WordPress
 * @subpackage gfx
 */
?>

<footer class="footer">
    <div class="main-block">
        <div class="container">
            <div class="inner">
                <div class="logo-holder">
                    <a href="<?php echo get_home_url(); ?>">
                        <span>Premade</span>
                        <span class="red">GFX</span>
                    </a>
                </div>

                <?php if (has_nav_menu('footer_menu')) : ?>
                    <div class="menu-holder">
                        <?php wp_nav_menu(['theme_location' => 'footer_menu', 'container' => '']); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="copyrights-block">
        <div class="container">
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
