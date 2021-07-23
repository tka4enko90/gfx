<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (is_user_logged_in()) {
    return;
}

?>
<form class="woocommerce-form woocommerce-form-login login"
      method="post" <?php echo ($hidden) ? 'style="display:none;"' : ''; ?>>

    <?php do_action('woocommerce_login_form_start'); ?>

    <?php echo ($message) ? wpautop(wptexturize($message)) : ''; // @codingStandardsIgnoreLine ?>

    <div class="input-wrapper">
        <label for="username"><?php esc_html_e('Email address', 'gfx'); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="input-text" placeholder="<?php _e('Enter your email', 'gfx') ?>" name="username"
               id="username" autocomplete="username"/>
    </div>
    <div class="input-wrapper">
        <label for="password"><?php esc_html_e('Password', 'gfx'); ?>&nbsp;<span class="required">*</span></label>
        <input class="input-text" type="password" placeholder="<?php _e('Enter your password', 'gfx') ?>"
               name="password" id="password" autocomplete="current-password"/>
    </div>

    <?php do_action('woocommerce_login_form'); ?>

    <div class="submit-wrapper">
        <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
        <input type="hidden" name="redirect" value="<?php echo esc_url($redirect); ?>"/>
        <button type="submit" class="primary-button" name="login" value="<?php esc_attr_e('Log In', 'gfx'); ?>"><?php esc_html_e('Log In', 'gfx'); ?></button>

        <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Forgotten your password?', 'gfx'); ?></a>
    </div>
    <?php do_action('woocommerce_login_form_end'); ?>
</form>
