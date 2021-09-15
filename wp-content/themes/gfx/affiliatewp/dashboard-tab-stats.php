<?php
$affiliate_id = affwp_get_affiliate_id();
?>
<div id="affwp-affiliate-dashboard-referral-counts" class="affwp-tab-content">
    <div class="container">
        <h3><?php _e('Statistics', 'gfx'); ?></h3>

        <h6><?php _e('Referrals', 'gfx'); ?></h6>

        <div class="referral-counts-blocks">
            <div class="block">
                <div class="holder">
                    <div class="icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/static/img/dollar.png" alt="icon">
                    </div>
                    <div class="info">
                        <div class="title">
                            <?php _e('Unpaid Referrals', 'gfx'); ?>
                        </div>
                        <div class="value">
                            <?php echo affwp_count_referrals($affiliate_id, 'unpaid'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="holder">
                    <div class="icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/static/img/dollar.png" alt="icon">
                    </div>
                    <div class="info">
                        <div class="title">
                            <?php _e('Paid Referrals', 'gfx'); ?>
                        </div>
                        <div class="value">
                            <?php echo affwp_count_referrals($affiliate_id, 'paid'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="holder">
                    <div class="icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/static/img/visit.png" alt="icon">
                    </div>
                    <div class="info">
                        <div class="title">
                            <?php _e('Visits', 'gfx'); ?>
                        </div>
                        <div class="value">
                            <?php echo affwp_count_visits($affiliate_id); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="holder">
                    <div class="icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/static/img/conversion.png" alt="icon">
                    </div>
                    <div class="info">
                        <div class="title">
                            <?php _e('Conversion Rate', 'gfx'); ?>
                        </div>
                        <div class="value">
                            <?php echo affwp_get_affiliate_conversion_rate($affiliate_id); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        /**
         * Fires immediately after stats counts in the affiliate area.
         *
         * @param int $affiliate_id Affiliate ID of the currently logged-in affiliate.
         * @since 1.0
         *
         */
        do_action('affwp_affiliate_dashboard_after_counts', $affiliate_id);
        ?>
    </div>
</div>

<div id="affwp-affiliate-dashboard-earnings-stats" class="affwp-tab-content">
    <div class="container">
        <h6><?php _e('Earnings', 'gfx'); ?></h6>

        <div class="earnings-blocks">
            <div class="block">
                <div class="holder">
                    <div class="icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/static/img/dollar.png" alt="icon">
                    </div>
                    <div class="info">
                        <div class="title">
                            <?php _e('Unpaid Earnings', 'gfx'); ?>
                        </div>
                        <div class="value">
                            <?php echo affwp_get_affiliate_unpaid_earnings($affiliate_id, true); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="holder">
                    <div class="icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/static/img/dollar.png" alt="icon">
                    </div>
                    <div class="info">
                        <div class="title">
                            <?php _e('Paid Earnings', 'gfx'); ?>
                        </div>
                        <div class="value">
                            <?php echo affwp_get_affiliate_earnings($affiliate_id, true); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="holder">
                    <div class="icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/static/img/commision.png" alt="icon">
                    </div>
                    <div class="info">
                        <div class="title">
                            <?php _e('Commission Rate', 'gfx'); ?>
                        </div>
                        <div class="value">
                            <?php echo affwp_get_affiliate_rate($affiliate_id, true); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        /**
         * Fires immediately after earnings stats in the affiliate area.
         *
         * @param int $affiliate_id Affiliate ID of the currently logged-in affiliate.
         * @since 1.0
         *
         */
        do_action('affwp_affiliate_dashboard_after_earnings', $affiliate_id);
        ?>
    </div>
</div>

<div id="affwp-affiliate-dashboard-campaign-stats" class="affwp-tab-content">
    <div class="container">
        <h6><?php _e('Campaigns', 'gfx'); ?></h6>

        <?php
        $per_page = -1;
        $page = affwp_get_current_page_number();
        $pages = absint(ceil(affiliate_wp()->campaigns->count(array('affiliate_id' => $affiliate_id)) / $per_page));
        $args = array(
            'number' => $per_page,
            'offset' => $per_page * ($page - 1),
        );

        $campaigns = affwp_get_affiliate_campaigns($affiliate_id, $args);
        ?>

        <div class="table-holder-bg">
            <div class="table-holder">
                <table>
                    <thead>
                    <tr>
                        <th><?php _e('Campaign', 'gfx'); ?></th>
                        <th><?php _e('Visits', 'gfx'); ?></th>
                        <th><?php _e('Unique Links', 'gfx'); ?></th>
                        <th><?php _e('Converted', 'gfx'); ?></th>
                        <th><?php _e('Conversion Rate', 'gfx'); ?></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if ($campaigns) :
                        foreach ($campaigns as $campaign) : ?>
                            <tr>
                                <td data-th="<?php _e('Campaign', 'gfx'); ?>">
                                    <?php echo !empty($campaign->campaign) ? esc_html($campaign->campaign) : __('None set', 'gfx'); ?></td>
                                <td data-th="<?php _e('Visits', 'gfx'); ?>">
                                    <?php echo esc_html($campaign->visits); ?></td>
                                <td data-th="<?php _e('Unique Links', 'gfx'); ?>">
                                    <?php echo esc_html($campaign->unique_visits); ?></td>
                                <td data-th="<?php _e('Converted', 'gfx'); ?>">
                                    <?php echo esc_html($campaign->referrals); ?></td>
                                <td data-th="<?php _e('Conversion Rate', 'gfx'); ?>">
                                    <?php echo esc_html(affwp_format_amount($campaign->conversion_rate)); ?> %
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr class="no-data">
                            <td class="affwp-table-no-data" data-th="<?php _e('Campaigns', 'gfx'); ?>"
                                colspan="5"><?php _e('You have no referrals or visits that included a campaign name.', 'gfx'); ?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
        /**
         * Fires immediately after campaign stats in the affiliate area.
         *
         * @param int $affiliate_id Affiliate ID of the currently logged-in affiliate.
         * @since 1.0
         *
         */
        do_action('affwp_affiliate_dashboard_after_campaign_stats', $affiliate_id);
        ?>
    </div>
</div>
