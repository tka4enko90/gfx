<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form'); ?>

<div class="col">
    <div class="my-account-info-block">
        <h3><?php _e('Manage Account Details', 'gfx'); ?></h3>
        <form class="woocommerce-EditAccountForm edit-account" action=""
              method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?> >

            <?php do_action('woocommerce_edit_account_form_start'); ?>

            <div class="input-wrapper">
                <label for="account_first_name"><?php esc_html_e('First Name', 'gfx'); ?>&nbsp;<span
                            class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                       name="account_first_name" id="account_first_name" autocomplete="given-name"
                       value="<?php echo esc_attr($user->first_name); ?>"/>
            </div>

            <div class="input-wrapper">
                <label for="account_last_name"><?php esc_html_e('Last Name', 'gfx'); ?>&nbsp;<span
                            class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                       name="account_last_name"
                       id="account_last_name" autocomplete="family-name"
                       value="<?php echo esc_attr($user->last_name); ?>"/>
            </div>

            <div class="input-wrapper">
                <label for="account_display_name"><?php esc_html_e('Display Name', 'gfx'); ?>&nbsp;<span
                            class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                       name="account_display_name" id="account_display_name"
                       value="<?php echo esc_attr($user->display_name); ?>"/>
                <span class="promt"><?php esc_html_e('This will be how your name will be displayed in the account section and in reviews', 'gfx'); ?></span>
            </div>

            <div class="input-wrapper">
                <label for="account_email"><?php esc_html_e('Email Address', 'gfx'); ?>&nbsp;<span
                            class="required">*</span></label>
                <input type="email" class="woocommerce-Input woocommerce-Input--email input-text"
                       name="account_email"
                       id="account_email" autocomplete="email" value="<?php echo esc_attr($user->user_email); ?>"/>
            </div>

            <h5><?php _e('Password Change', 'gfx'); ?></h5>
            <div class="input-wrapper">
                <label for="password_current"><?php esc_html_e('Current Password', 'gfx'); ?><span><?php _e('(Leave blank to leave unchanged)', 'gfx'); ?></span></label>
                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                       name="password_current" id="password_current" autocomplete="off"/>
            </div>
            <div class="input-wrapper">
                <label for="password_1"><?php _e('New Password', 'gfx'); ?><span><?php _e('(Leave blank to leave unchanged)', 'gfx'); ?></span></label>
                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                       name="password_1" id="password_1" autocomplete="off"/>
            </div>
            <div class="input-wrapper">
                <label for="password_2"><?php esc_html_e('Confirm New Password', 'gfx'); ?></label>
                <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                       name="password_2" id="password_2" autocomplete="off"/>
            </div>

            <?php do_action('woocommerce_edit_account_form'); ?>

            <div class="input-wrapper">
                <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
                <button type="submit" class="primary-button small" name="save_account_details"
                        value="<?php esc_attr_e('Save changes', 'gfx'); ?>"><?php esc_html_e('Save Changes', 'gfx'); ?></button>
                <input type="hidden" name="action" value="save_account_details"/>
            </div>

            <?php do_action('woocommerce_edit_account_form_end'); ?>
        </form>
    </div>
</div>

<?php do_action('woocommerce_after_edit_account_form'); ?>
