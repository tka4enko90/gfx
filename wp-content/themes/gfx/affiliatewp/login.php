<?php
global $affwp_login_redirect;
affiliate_wp()->login->print_errors();
?>

<form id="affwp-login-form" class="affwp-form" action="" method="post">
	<?php
	/**
	 * Fires at the top of the affiliate login form template
	 *
	 * @since 1.0
	 */
	do_action( 'affwp_affiliate_login_form_top' );
	?>

	<fieldset>
        <h3><?php _e('Log into your account', 'gfx'); ?></h3>

		<?php
		/**
		 * Fires immediately prior to the affiliate login form template fields.
		 *
		 * @since 1.0
		 */
		do_action( 'affwp_login_fields_before' );
		?>

		<p>
			<label for="affwp-login-user-login"><?php _e( 'Username', 'affiliate-wp' ); ?><span>*</span></label>
			<input id="affwp-login-user-login" required class="required" type="text" name="affwp_user_login" title="<?php esc_attr_e( 'Username', 'affiliate-wp' ); ?>" />
		</p>

		<p>
			<label for="affwp-login-user-pass"><?php _e( 'Password', 'affiliate-wp' ); ?><span>*</span></label>
			<input id="affwp-login-user-pass" required class="password required" type="password" name="affwp_user_pass" />
		</p>

        <div class="terms-holder">
            <label class="affwp-user-remember" for="affwp-user-remember">
                <input id="affwp-user-remember" type="checkbox" name="affwp_user_remember" value="1" />
                <?php _e( 'Remember Me', 'gfx' ); ?>
            </label>
        </div>

		<p>
			<input type="hidden" name="affwp_redirect" value="<?php echo esc_url( $affwp_login_redirect ); ?>"/>
			<input type="hidden" name="affwp_login_nonce" value="<?php echo wp_create_nonce( 'affwp-login-nonce' ); ?>" />
			<input type="hidden" name="affwp_action" value="user_login" />
			<input type="submit" class="primary-button"  class="button" value="<?php esc_attr_e( 'Log In', 'gfx' ); ?>" />
		</p>

		<p class="affwp-lost-password">
			<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'gfx' ); ?></a>
		</p>

		<?php
		/**
		 * Fires immediately after the affiliate login form template fields.
		 *
		 * @since 1.0
		 */
		do_action( 'affwp_login_fields_after' );
		?>
	</fieldset>

	<?php
	/**
	 * Fires at the bottom of the affiliate login form template (inside the form element).
	 *
	 * @since 1.0
	 */
	do_action( 'affwp_affiliate_login_form_bottom' );
	?>
</form>
