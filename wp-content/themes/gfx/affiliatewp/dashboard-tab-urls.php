<?php
$affiliate_id = affwp_get_affiliate_id();
?>
<div id="affwp-affiliate-dashboard-url-generator" class="affwp-tab-content">
    <div class="container">
        <h3><?php _e('Affiliate URLs', 'gfx'); ?></h3>

        <?php
        /**
         * Fires at the top of the Affiliate URLs dashboard tab.
         *
         * @param int $affiliate_id Affiliate ID of the currently logged-in affiliate.
         * @since 2.0.5
         *
         */
        do_action('affwp_affiliate_dashboard_urls_top', $affiliate_id);
        ?>

        <div class="affiliate-info">
            <h6><?php _e('Referral URL', 'gfx'); ?></h6>
            <div class="referral-url-holder">
                <p>
                    <?php _e('Share your referral URL with your audience to earn commission.', 'gfx'); ?>
                </p>
                <div class="referral-url">
                    <p>
                        <?php echo esc_url(urldecode(affwp_get_affiliate_referral_url())); ?>
                    </p>
                    <button class="copy-btn" data-value="<?php echo esc_url(urldecode(affwp_get_affiliate_referral_url())); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/static/img/copy.png" alt="copy icon">
                    </button>
                </div>
            </div>
        </div>

        <?php
        /**
         * Fires just before the Referral URL Generator.
         *
         * @param int $affiliate_id Affiliate ID of the currently logged-in affiliate.
         * @since 2.0.5
         *
         */
        do_action('affwp_affiliate_dashboard_urls_before_generator', $affiliate_id);
        ?>
        <div class="referral-url-generator">
            <h6><?php _e('Referral URL Generator', 'gfx'); ?></h6>
            <p><?php _e('Enter any URL from our website in the form below to generate a custom referral link!', 'gfx'); ?></p>

            <form id="affwp-generate-ref-url" class="affwp-form" method="get" action="#affwp-generate-ref-url">
                <div class="affwp-wrap affwp-base-url-wrap">
                    <label for="affwp-url"><?php _e('Page URL', 'gfx'); ?></label>
                    <input type="text" name="url" id="affwp-url"
                           placeholder="<?php echo esc_url(urldecode(affwp_get_affiliate_base_url())); ?>"/>
                </div>

                <div class="affwp-wrap affwp-campaign-wrap">
                    <label for="affwp-campaign"><?php _e('Campaign Name (Optional)', 'gfx'); ?>
                        <span><?php _e('Enter an optional campaign name to help track performance.', 'gfx'); ?></span>
                    </label>
                    <input type="text" name="campaign" id="affwp-campaign" placeholder="Campaign 1" value=""/>
                </div>

                <div class="affwp-wrap affwp-referral-url-wrap" <?php if (!isset($_GET['url'])) {
                    echo 'style="display:none;"';
                } ?>>
                    <label for="affwp-referral-url"><?php _e('Referral URL', 'gfx'); ?>
                        <span><?php _e('Copy this referral link and share it anywhere!', 'gfx'); ?></span>
                    </label>
                    <div class="copy-link-holder">
                        <input type="text" id="affwp-referral-url" class="text-to-copy"
                               value="<?php echo esc_url(urldecode(affwp_get_affiliate_referral_url())); ?>"/>
                        <button class="copy-btn">
                            <?php _e('Copy Link', 'gfx'); ?>
                        </button>
                    </div>
                </div>

                <div class="affwp-referral-url-submit-wrap">
                    <input type="hidden" class="affwp-affiliate-id"
                           value="<?php echo esc_attr(urldecode(affwp_get_referral_format_value())); ?>"/>
                    <input type="hidden" class="affwp-referral-var"
                           value="<?php echo esc_attr(affiliate_wp()->tracking->get_referral_var()); ?>"/>
                    <input type="submit" class="primary-button" value="<?php _e('Generate URL', 'gfx'); ?>"/>
                </div>
            </form>
        </div>

        <?php
        /**
         * Fires at the bottom of the Affiliate URLs dashboard tab.
         *
         * @param int $affiliate_id Affiliate ID of the currently logged-in affiliate.
         * @since 2.0.5
         *
         */
        do_action('affwp_affiliate_dashboard_urls_bottom', $affiliate_id);
        ?>
    </div>
</div>
