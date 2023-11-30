<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_get_template( 'cart/cart-panel.php' ); ?>

<section class="check">
	<div class="container check__container">
		<?php
			/**
			 * Before checkout form hook.
			 * //@hooked woocommerce_checkout_coupon_form - 10
			 */

			do_action( 'woocommerce_before_checkout_form', $checkout );

			// If checkout registration is disabled and not logged in, the user cannot checkout.
			if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
				echo '<h2 class="check__must-login">Um eine Bestellung aufzugeben, müssen Sie sich anmelden.</h2>';
				echo '<button type="button" class="btn btn--black check__must-btn" data-fancybox data-src="#login">Anmeldung</button>';
				return;
			}
		?>

		<form name="checkout" method="post" class="checkout check__form woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

			<?php if ( $checkout->get_checkout_fields() ) : ?>

				<?php
					/**
					 * Checkout before customer details hook.
					 *
					 * //@hooked wc_get_pay_buttons - 30
					 */
					do_action( 'woocommerce_checkout_before_customer_details' );
				?>

				<?php do_action( 'woocommerce_checkout_billing' ); //Form-blilling template ?>

				<?php //do_action( 'woocommerce_checkout_shipping' ); ?>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); //Empty ?>

			<?php endif; ?>

			<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); //Action for Twenty_Twenty_Two theme ?>

			<?php do_action( 'woocommerce_checkout_before_order_review' ); //Action for Twenty_Twenty_Two theme ?>

			<?php do_action( 'woocommerce_checkout_order_review' ); //Review-order template ?>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); //Action for Twenty_Twenty_Two theme ?>

		</form>

		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); //Empty ?>
	</div>
</section>
