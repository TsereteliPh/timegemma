<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart__totals cart_totals<?php //echo ( WC()->customer->has_calculated_shipping() ) ? ' calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<h2 class="cart__title">Bestellübersicht</h2>

	<?php if ( is_checkout() || WC()->cart->get_coupons() ) : ?>
		<div class="cart__subtotal">
			<div class="cart__subtotal-label">Zwischensumme:</div>
			<div class="cart__summ" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></div>
		</div>
	<?php endif; ?>

	<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
		<div class="cart__coupon-active coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
			<div class="cart__coupon-label"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
			<div class="cart__coupon-diff"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
		</div>
	<?php endforeach; ?>

	<?php
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
				/* translators: %s location. */
				$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
			}

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					?>
					<div class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<div><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
						<div data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
					</div>
					<?php
				}
			} else {
				?>
				<div class="tax-total">
					<div><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
					<div data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></div>
				</div>
				<?php
			}
		}
	?>

	<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

	<div class="cart__order-total">
		<div>Bestellpreis:</div>
		<div class="cart__summ" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></div>
	</div>

	<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	<?php if ( wc_coupons_enabled() ) : ?>
		<div class="cart__coupon coupon">
			<label for="coupon_code">Aktionscode</label>
			<input type="text" name="coupon_code" class="cart__coupon-input input-text" id="coupon_code" value="" placeholder="Aktionscode eingeben" />
			<button type="submit" class="cart__coupon-btn <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"></button>
			<?php do_action( 'woocommerce_cart_coupon' ); ?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>