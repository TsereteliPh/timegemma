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

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}
?>

<div class="account__panel">
	<a class="account__panel-link account__panel-link--fav">
		<div class="account__panel-count">
			Favoriten
			<span><?php echo 5; //todo Fav link and count ?></span>
		</div>
	</a>

	<a href="<?php echo wc_get_cart_url(); ?>" class="account__panel-link account__panel-link--cart">
		<div class="account__panel-count">
			Korb
			<span><?php echo WC()->cart->get_cart_contents_count(); ?></span>
		</div>

		<?php if ( WC()->cart->get_cart_contents_count() > 0 ) : ?>
			<div class="account__panel-desc">
				Artikel im Warenkorb für den Betrag:
				<span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
			</div>
		<?php endif; ?>
	</a>

	<a href="<?php echo esc_url( wc_get_endpoint_url( 'orders' ) ); ?>" class="account__panel-link account__panel-link--orders">
		<div class="account__panel-count">Geschichte der Bestellungen</div>
	</a>

	<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address' ) ); ?>" class="account__panel-link account__panel-link--address">
		<div class="account__panel-count">Adressen</div>
	</a>

	<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account' ) ); ?>" class="account__panel-link account__panel-link--address">
		<div class="account__panel-count">Persönliche Daten</div>
	</a>
</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' ); //Empty

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' ); //Empty

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' ); //Empty

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
