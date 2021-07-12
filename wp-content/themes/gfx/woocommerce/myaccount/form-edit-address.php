<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

$page_title = ('billing' === $load_address) ? esc_html__('Billing address', 'woocommerce') : esc_html__('Shipping address', 'woocommerce');

do_action('woocommerce_before_edit_account_address_form'); ?>

    <div class="my-account-info-block my-account-edit-address-block">
        <?php if (!$load_address) : ?>
            <?php wc_get_template('myaccount/my-address.php'); ?>
        <?php else : ?>
            <h3><?php _e('Billing address', 'gfx'); ?></h3>
            <form method="post" class="edit-address">
                <?php do_action("woocommerce_before_edit_address_form_{$load_address}"); ?>

                <?php
                foreach ($address as $key => $field) {
                    $field['return'] = true;
                    $field = woocommerce_form_field($key, $field, wc_get_post_data_by_key($key, $field['value']));

                    // change p wrapper on div
                    $field = preg_replace(
                        '#<p class="form-row (.*?)"(.*?)>(.*?)</p>#',
                        '<div class="input-wrapper"$2>$3</div>',
                        $field
                    );
                    // remove span wrapper
                    $field = str_replace(
                        '<span class="woocommerce-input-wrapper">',
                        '',
                        $field
                    );
                    $field = str_replace(
                        '</span>',
                        '',
                        $field
                    );

                    echo $field;
                }
                ?>

                <?php do_action("woocommerce_after_edit_address_form_{$load_address}"); ?>
                <div class="input-wrapper">
                    <button type="submit" class="primary-button small" name="save_address"
                            value="<?php esc_attr_e('Save address', 'woocommerce'); ?>"><?php esc_html_e('Save address', 'woocommerce'); ?></button>
                    <?php wp_nonce_field('woocommerce-edit_address', 'woocommerce-edit-address-nonce'); ?>
                    <input type="hidden" name="action" value="edit_address"/>
                </div>
            </form>
        <?php endif; ?>
    </div>

<?php do_action('woocommerce_after_edit_account_address_form'); ?>
