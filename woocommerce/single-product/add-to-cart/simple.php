<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
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

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php if ( ! is_product_in_cart() ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

		<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

			<?php
				do_action( 'woocommerce_before_add_to_cart_quantity' );

				do_action( 'woocommerce_after_add_to_cart_quantity' );
			?>

			<button name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="btn btn--black product__add-to-cart-btn" type="submit">
				In den Warenkorb
				<svg width="18" height="20"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-cart"></use></svg>
			</button>

			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		</form>

		<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

	<?php else : ?>
		<div class="btn btn--black product__added-to-cart-btn">
			<button class="product__remove-one" type="button">-</button>

			<span class="product__added-in-cart"><?php echo get_product_quantity_in_cart( $product->get_id() ); ?></span>

			<button class="product__add-one" type="button">+</button>
		</div>
	<?php endif; ?>

	<?php
		// echo '<pre>';
		// print_r( WC()->cart );
		// echo '</pre>';
	?>

<?php else : ?>
	<div class="btn product__unavailable">Nicht verfügbar</div>
<?php endif; ?>
