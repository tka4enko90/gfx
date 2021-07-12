<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<?php if (!empty($downloads)) : ?>
    <div class="woocommerce-order-downloads">
        <?php if (isset($show_title)) : ?>
            <h2 class="woocommerce-order-downloads__title"><?php esc_html_e('Downloads', 'woocommerce'); ?></h2>
        <?php endif; ?>

        <?php $downloads_page = 1; ?>
        <?php $downloads_per_page = 1; ?>
        <?php $downloads_count = count($downloads); ?>
        <?php $downloads_offset = 0; ?>
        <?php $downloads_number_of_pages = $downloads_count / $downloads_per_page; ?>

        <div class="table-holder">
            <?php get_template_part('woocommerce/order/order-downloads-table', '',
                array(
                    'downloads' => $downloads,
                    'downloads_offset' => $downloads_offset,
                    'downloads_per_page' => $downloads_per_page,
                )); ?>
        </div>

        <?php if ($downloads_number_of_pages > 1) : ?>
            <div class="posts-pagination my-account-downloads-pagination"
                 data-downloads='<?php echo json_encode($downloads); ?>'
                 data-downloads-current-page="1"
                 data-downloads-last-page="<?php echo $downloads_number_of_pages; ?>"
                 data-downloads-per-page="<?php echo $downloads_per_page; ?>">

                <button class="prev page-numbers hidden">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px"
                         y="0px" viewBox="0 0 492 492" style="fill:white;enable-background:new 0 0 492 492;"
                         xml:space="preserve">
                                        <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
                                            C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
                                            c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
                                            l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
                                </svg>
                </button>

                <?php for ($i = 0; $i < $downloads_number_of_pages; $i++) : ?>
                    <?php $page_num = $i; ?>
                    <?php ++$page_num; ?>

                    <button class="page-numbers page-number <?php echo $page_num === 1 ? 'current' : '' ?>"><?php echo $page_num; ?></button>
                <?php endfor; ?>
                <button class="next page-numbers">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px"
                         y="0px" viewBox="0 0 492.004 492.004"
                         style="fill:white;enable-background:new 0 0 492.004 492.004;"
                         xml:space="preserve">
                                        <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                            c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                            c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                            c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"></path>
                                </svg>
                </button>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>