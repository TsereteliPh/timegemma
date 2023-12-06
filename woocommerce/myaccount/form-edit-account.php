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
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); //Empty ?>

<form class="woocommerce-EditAccountForm edit-account account__edit" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); //Empty ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); //Empty ?>

	<div class="account__edit-info">
		<fieldset class="fieldset">
			<legend><?php esc_html_e( 'First name', 'woocommerce' ); ?></legend>
			<input type="text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>"/>
		</fieldset>

		<fieldset class="fieldset">
			<legend><?php esc_html_e( 'Last name', 'woocommerce' ); ?></legend>
			<input type="text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>"/>
		</fieldset>

		<fieldset class="fieldset">
			<legend><?php echo esc_html_e( 'Display name', 'woocommerce' ); ?></legend>
			<input type="text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>"/>
		</fieldset>

		<fieldset class="fieldset">
			<legend><?php echo esc_html_e( 'Email address', 'woocommerce' ); ?></legend>
			<input type="email" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>"/>
		</fieldset>
	</div>

	<div class="account__edit-password">
		<h3 class="account__edit-title"><?php esc_html_e( 'Password change', 'woocommerce' ); ?></h3>

		<fieldset class="fieldset">
			<legend><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></legend>
			<input type="password" class="woocommerce-Input woocommerce-Input--password" name="password_current" id="password_current" autocomplete="off" />
		</fieldset>

		<fieldset class="fieldset">
			<legend><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?></legend>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
		</fieldset>

		<fieldset class="fieldset">
			<legend><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></legend>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
		</fieldset>
	</div>

	<?php do_action( 'woocommerce_edit_account_form' ); //Empty ?>

	<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
	<button type="submit" class="btn btn--black account__edit-submit <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
	<input type="hidden" name="action" value="save_account_details" />

	<?php do_action( 'woocommerce_edit_account_form_end' ); //Empty ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); //Empty ?>
