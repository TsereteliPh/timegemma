<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="thankyou">
	<div class="container thankyou__container">
		<?php do_action( 'woocommerce_before_thankyou', $order->get_id() ); //Empty ?>

		<?php if ( $order->has_status( 'failed' ) || ! $order ) : ?>
			<div class="thankyou__message">Leider wurde Ihre Bestellung nicht angenommen. Versuchen Sie es erneut</div>

			<a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="btn btn--dark btn--dial thankyou__link">
				Katalog
				<div class="btn__dial">
					<svg width="83" height="76"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-dial"></use></svg>
				</div>
			</a>
		<?php else : ?>
			<div class="thankyou__message">
				Ihre Bestellung Nr. <?php echo $order->get_id(); ?> im Wert von
				<span><?php echo $order->total . get_woocommerce_currency_symbol( $order->currency ); ?> wurde erfolgreich abgeschlossen!</span>
			</div>

			<a href="<?php echo is_user_logged_in() ? $order->get_view_order_url() : bloginfo( 'url' ); ?>" class="btn btn--dark btn--dial thankyou__link">
				Einzelheiten
				<div class="btn__dial">
					<svg width="83" height="76"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-dial"></use></svg>
				</div>
			</a>
		<?php endif; ?>
	</div>
</section>
