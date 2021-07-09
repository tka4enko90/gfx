<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$allowed_html = array(
    'a' => array(
        'href' => array(),
    ),
);
?>

<div class="my-account-info-block dashboard-section">
    <?php $orders_link = wc_get_endpoint_url('orders'); ?>
    <?php $downloads_link = wc_get_endpoint_url('downloads'); ?>
    <?php $address_link = wc_get_endpoint_url('edit-address'); ?>
    <?php $payment_methods_link = wc_get_endpoint_url('payment-methods'); ?>
    <?php $account_details_link = wc_get_endpoint_url('edit-account'); ?>
    <?php $logout_link = wp_logout_url(); ?>

    <h3><?php _e('Dashboard', 'gfx'); ?></h3>
    <div class="section-description">
        <?php
        /* translators: 1: Orders URL 2: Address URL 3: Account URL. */
        $dashboard_desc = __('From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and edit your password and <a href="%3$s">account details</a>.', 'woocommerce');
        if (wc_shipping_enabled()) {
            /* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
            $dashboard_desc = __('From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and edit your password and <a href="%3$s">account details</a>.', 'woocommerce');
        }
        printf(
            wp_kses($dashboard_desc, $allowed_html),
            esc_url($orders_link),
            esc_url($address_link),
            esc_url($account_details_link)
        );
        ?>
    </div>

    <div class="links-holder">
        <?php if (!empty($orders_link)) : ?>
            <a href="<?php echo $orders_link; ?>" class="link">
                <div class="holder">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             version="1.1" width="512" height="512" x="0" y="0"
                             viewBox="0 0 512.00033 512" style="enable-background:new 0 0 512 512" xml:space="preserve"
                             class=""><g>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="m166 300.003906h271.003906c6.710938 0 12.597656-4.4375 14.414063-10.882812l60.003906-210.003906c1.289063-4.527344.40625-9.390626-2.433594-13.152344-2.84375-3.75-7.265625-5.964844-11.984375-5.964844h-365.632812l-10.722656-48.25c-1.523438-6.871094-7.617188-11.75-14.648438-11.75h-91c-8.289062 0-15 6.710938-15 15 0 8.292969 6.710938 15 15 15h78.960938l54.167968 243.75c-15.9375 6.929688-27.128906 22.792969-27.128906 41.253906 0 24.8125 20.1875 45 45 45h271.003906c8.292969 0 15-6.707031 15-15 0-8.289062-6.707031-15-15-15h-271.003906c-8.261719 0-15-6.722656-15-15s6.738281-15 15-15zm0 0"
                                      fill="#ff0036" data-original="#000000" style="" class=""/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="m151 405.003906c0 24.816406 20.1875 45 45.003906 45 24.8125 0 45-20.183594 45-45 0-24.8125-20.1875-45-45-45-24.816406 0-45.003906 20.1875-45.003906 45zm0 0"
                                      fill="#ff0036" data-original="#000000" style="" class=""/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="m362.003906 405.003906c0 24.816406 20.1875 45 45 45 24.816406 0 45-20.183594 45-45 0-24.8125-20.183594-45-45-45-24.8125 0-45 20.1875-45 45zm0 0"
                                      fill="#ff0036" data-original="#000000" style="" class=""/>
                            </g></svg>
                    </div>
                    <?php _e('Orders', 'gfx'); ?>
                </div>
            </a>
        <?php endif; ?>

        <?php if (!empty($downloads_link)) : ?>
            <a href="<?php echo $downloads_link; ?>" class="link">
                <div class="holder">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             version="1.1" width="512" height="512" x="0" y="0"
                             viewBox="0 0 944.699 944.699" style="enable-background:new 0 0 512 512"
                             xml:space="preserve"
                             class=""><g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                    <path d="M894.801,579.05h-309.5l-41.5,47.199c-18,20.5-44.102,32.301-71.401,32.301c-27.3,0-53.4-11.801-71.4-32.301l-41.5-47.199   H50c-27.6,0-50,22.4-50,50v198.5c0,27.6,22.4,50,50,50h844.699c27.602,0,50-22.4,50-50v-198.5   C944.801,601.45,922.4,579.05,894.801,579.05z M139.2,770.95c-23.5,0-42.6-19.102-42.6-42.602s19.1-42.6,42.6-42.6   s42.6,19.1,42.6,42.6S162.7,770.95,139.2,770.95z"
                                          fill="#ff0036" data-original="#000000" style="" class=""/>
                                    <path d="M419.4,579.05l15.4,17.6c10,11.301,23.8,17,37.6,17c13.799,0,27.6-5.699,37.6-17l15.4-17.6L734.1,341.25   c28.4-32.3,5.4-83-37.6-83h-65.6v-141.1c0-27.6-22.4-50-50-50h-217c-27.6,0-50,22.4-50,50v141.2h-65.6c-43,0-65.9,50.7-37.6,83   L419.4,579.05z"
                                          fill="#ff0036" data-original="#000000" style="" class=""/>
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                            </g></svg>
                    </div>
                    <?php _e('Downloads', 'gfx'); ?>
                </div>
            </a>
        <?php endif; ?>

        <?php if (!empty($address_link)) : ?>
            <a href="<?php echo $address_link; ?>" class="link">
                <div class="holder">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="512" height="512" x="0" y="0" viewBox="0 0 425.963 425.963"
                             style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                    <path d="M213.285,0h-0.608C139.114,0,79.268,59.826,79.268,133.361c0,48.202,21.952,111.817,65.246,189.081   c32.098,57.281,64.646,101.152,64.972,101.588c0.906,1.217,2.334,1.934,3.847,1.934c0.043,0,0.087,0,0.13-0.002   c1.561-0.043,3.002-0.842,3.868-2.143c0.321-0.486,32.637-49.287,64.517-108.976c43.03-80.563,64.848-141.624,64.848-181.482   C346.693,59.825,286.846,0,213.285,0z M274.865,136.62c0,34.124-27.761,61.884-61.885,61.884   c-34.123,0-61.884-27.761-61.884-61.884s27.761-61.884,61.884-61.884C247.104,74.736,274.865,102.497,274.865,136.62z"
                                          fill="#ff0036" data-original="#000000" style="" class=""/>
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                            </g></svg>
                    </div>
                    <?php _e('Addresses', 'gfx'); ?>
                </div>
            </a>
        <?php endif; ?>

        <?php if (!empty($payment_methods_link)) : ?>
            <a href="<?php echo $payment_methods_link; ?>" class="link">
                <div class="holder">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="512" height="512" x="0" y="0" viewBox="0 0 512 512"
                             style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="M512,307.2V204.8l-61.44-15.36c-2.56-7.68-5.12-15.36-10.24-23.04l33.28-56.32L401.92,38.4L345.6,71.68    c-7.68-2.56-15.36-7.68-23.04-10.24L307.2,0H204.8l-15.36,61.44c-7.68,5.12-15.36,7.68-23.04,10.24L110.08,38.4L38.4,110.08    l33.28,56.32c-2.56,7.68-7.68,15.36-10.24,23.04L0,204.8v102.4l61.44,15.36c2.56,7.68,5.12,15.36,10.24,23.04L38.4,401.92    l71.68,71.68l56.32-33.28c7.68,2.56,15.36,7.68,23.04,10.24L204.8,512h102.4l15.36-61.44c7.68-2.56,15.36-5.12,23.04-10.24    l56.32,33.28l71.68-71.68l-33.28-56.32c2.56-7.68,7.68-15.36,10.24-23.04L512,307.2z M256,332.8c-43.52,0-76.8-33.28-76.8-76.8    s33.28-76.8,76.8-76.8s76.8,33.28,76.8,76.8S299.52,332.8,256,332.8z"
                                              fill="#ff0036" data-original="#000000" style="" class=""/>
                                    </g>
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                            </g></svg>
                    </div>
                    <?php _e('Payment Methods', 'gfx'); ?>
                </div>
            </a>
        <?php endif; ?>

        <?php if (!empty($account_details_link)) : ?>
            <a href="<?php echo $account_details_link; ?>" class="link">
                <div class="holder">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="512" height="512" x="0" y="0" viewBox="0 0 512 512.002"
                             style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="m210.351562 246.632812c33.882813 0 63.222657-12.152343 87.195313-36.128906 23.972656-23.972656 36.125-53.304687 36.125-87.191406 0-33.875-12.152344-63.210938-36.128906-87.191406-23.976563-23.96875-53.3125-36.121094-87.191407-36.121094-33.886718 0-63.21875 12.152344-87.191406 36.125s-36.128906 53.308594-36.128906 87.1875c0 33.886719 12.15625 63.222656 36.132812 87.195312 23.976563 23.96875 53.3125 36.125 87.1875 36.125zm0 0"
                                      fill="#ff0036" data-original="#000000" style="" class=""/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="m426.128906 393.703125c-.691406-9.976563-2.089844-20.859375-4.148437-32.351563-2.078125-11.578124-4.753907-22.523437-7.957031-32.527343-3.308594-10.339844-7.808594-20.550781-13.371094-30.335938-5.773438-10.15625-12.554688-19-20.164063-26.277343-7.957031-7.613282-17.699219-13.734376-28.964843-18.199219-11.226563-4.441407-23.667969-6.691407-36.976563-6.691407-5.226563 0-10.28125 2.144532-20.042969 8.5-6.007812 3.917969-13.035156 8.449219-20.878906 13.460938-6.707031 4.273438-15.792969 8.277344-27.015625 11.902344-10.949219 3.542968-22.066406 5.339844-33.039063 5.339844-10.972656 0-22.085937-1.796876-33.046874-5.339844-11.210938-3.621094-20.296876-7.625-26.996094-11.898438-7.769532-4.964844-14.800782-9.496094-20.898438-13.46875-9.75-6.355468-14.808594-8.5-20.035156-8.5-13.3125 0-25.75 2.253906-36.972656 6.699219-11.257813 4.457031-21.003906 10.578125-28.96875 18.199219-7.605469 7.28125-14.390625 16.121094-20.15625 26.273437-5.558594 9.785157-10.058594 19.992188-13.371094 30.339844-3.199219 10.003906-5.875 20.945313-7.953125 32.523437-2.058594 11.476563-3.457031 22.363282-4.148437 32.363282-.679688 9.796875-1.023438 19.964844-1.023438 30.234375 0 26.726562 8.496094 48.363281 25.25 64.320312 16.546875 15.746094 38.441406 23.734375 65.066406 23.734375h246.53125c26.625 0 48.511719-7.984375 65.0625-23.734375 16.757813-15.945312 25.253906-37.585937 25.253906-64.324219-.003906-10.316406-.351562-20.492187-1.035156-30.242187zm0 0"
                                      fill="#ff0036" data-original="#000000" style="" class=""/>
                            </g></svg>
                    </div>
                    <?php _e('Account Details', 'gfx'); ?>
                </div>
            </a>
        <?php endif; ?>

        <?php if (!empty($logout_link)) : ?>
            <a href="<?php echo $logout_link; ?>" class="link">
                <div class="holder">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="512" height="512" x="0" y="0" viewBox="0 0 512 512"
                             style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g>
                                <g xmlns="http://www.w3.org/2000/svg" id="Solid">
                                    <path d="m480.971 239.029-90.51-90.509a24 24 0 0 0 -33.942 0 24 24 0 0 0 0 33.941l49.54 49.539h-262.059a24 24 0 0 0 -24 24 24 24 0 0 0 24 24h262.059l-49.54 49.539a24 24 0 0 0 33.942 33.941l90.51-90.51a24 24 0 0 0 0-33.941z"
                                          fill="#ff0036" data-original="#000000" style="" class=""/>
                                    <path d="m304 392a24 24 0 0 0 -24 24v24h-208v-368h208v24a24 24 0 0 0 48 0v-32a40 40 0 0 0 -40-40h-224a40 40 0 0 0 -40 40v384a40 40 0 0 0 40 40h224a40 40 0 0 0 40-40v-32a24 24 0 0 0 -24-24z"
                                          fill="#ff0036" data-original="#000000" style="" class=""/>
                                </g>
                            </g></svg>
                    </div>
                    <?php _e('Logout', 'gfx'); ?>
                </div>
            </a>
        <?php endif; ?>
    </div>
    <?php
    /**
     * My Account dashboard.
     *
     * @since 2.6.0
     */
    do_action('woocommerce_account_dashboard');

    /**
     * Deprecated woocommerce_before_my_account action.
     *
     * @deprecated 2.6.0
     */
    do_action('woocommerce_before_my_account');

    /**
     * Deprecated woocommerce_after_my_account action.
     *
     * @deprecated 2.6.0
     */
    do_action('woocommerce_after_my_account');

    /* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */ ?>
</div>


