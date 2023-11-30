<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

/**
 * //@hooked wc_empty_cart_message - 10
 */
do_action( 'woocommerce_cart_is_empty' );
?>

<section class="empty-cart">
	<div class="container empty-cart__container">
		<h1 class="empty-cart__title">Dein Korb ist leer</h1>

		<div class="empty-cart__message">Gehen Sie zur Katalogseite und beginnen Sie jetzt mit dem Einkaufen</div>

		<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
			<a class="btn btn--black empty-cart__link" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">Katalog</a>
		<?php endif; ?>
	</div>
</section>


