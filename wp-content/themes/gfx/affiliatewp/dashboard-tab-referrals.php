<?php
$affiliate_id = affwp_get_affiliate_id();
?>

<div id="affwp-affiliate-dashboard-referrals" class="affwp-tab-content">
    <div class="container">
        <h3><?php _e('Referrals', 'gfx'); ?></h3>

        <?php
        $per_page = -1;
        $statuses = array('paid', 'unpaid', 'rejected');
        $page = affwp_get_current_page_number();
        $pages = absint(ceil(affwp_count_referrals($affiliate_id, $statuses) / $per_page));
        /** @var \AffWP\Referral[] $referrals */
        $referrals = affiliate_wp()->referrals->get_referrals(
            array(
                'number' => $per_page,
                'offset' => $per_page * ($page - 1),
                'affiliate_id' => $affiliate_id,
                'status' => $statuses,
            )
        );
        ?>

        <?php
        /**
         * Fires before the referrals dashboard data table within the referrals template.
         *
         * @param int $affiliate_id Affiliate ID.
         * @since 1.0
         *
         */
        do_action('affwp_referrals_dashboard_before_table', $affiliate_id);
        ?>

        <div class="table-holder-bg">
            <div class="table-holder">
                <table id="affwp-affiliate-dashboard-referrals">
                    <thead>
                    <tr>
                        <th class="referral-amount"><?php _e('Amount', 'gfx'); ?></th>
                        <th class="referral-description"><?php _e('Description', 'gfx'); ?></th>
                        <th class="referral-status"><?php _e('Status', 'gfx'); ?></th>
                        <th class="referral-date"><?php _e('Date', 'gfx'); ?></th>
                        <?php
                        /**
                         * Fires in the dashboard referrals template, within the table header element.
                         *
                         * @since 1.0
                         */
                        do_action('affwp_referrals_dashboard_th');
                        ?>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if ($referrals) : ?>

                        <?php foreach ($referrals as $referral) : ?>
                            <tr>
                                <td class="referral-amount"
                                    data-th="<?php _e('Amount', 'gfx'); ?>"><?php echo affwp_currency_filter(affwp_format_amount($referral->amount)); ?></td>
                                <td class="referral-description"
                                    data-th="<?php _e('Description', 'gfx'); ?>"><?php echo wp_kses_post(nl2br($referral->description)); ?></td>
                                <td class="referral-status <?php echo $referral->status; ?>"
                                    data-th="<?php _e('Status', 'gfx'); ?>"><?php echo affwp_get_referral_status_label($referral); ?></td>
                                <td class="referral-date"
                                    data-th="<?php _e('Date', 'gfx'); ?>"><?php echo esc_html($referral->date_i18n()); ?></td>
                                <?php
                                /**
                                 * Fires within the table data of the dashboard referrals template.
                                 *
                                 * @param \AffWP\Referral $referral Referral object.
                                 * @since 1.0
                                 *
                                 */
                                do_action('affwp_referrals_dashboard_td', $referral); ?>
                            </tr>
                        <?php endforeach; ?>

                    <?php else : ?>

                        <tr>
                            <td class="affwp-table-no-data"
                                colspan="5"><?php _e('You have not made any referrals yet.', 'gfx'); ?></td>
                        </tr>

                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
        /**
         * Fires after the data table within the affiliate area referrals template.
         *
         * @param int $affiliate_id Affiliate ID.
         * @since 1.0
         *
         */
        do_action('affwp_referrals_dashboard_after_table', $affiliate_id);
        ?>
    </div>
</div>
