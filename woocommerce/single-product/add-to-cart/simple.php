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

defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) return;

echo wc_get_stock_html($product); // WPCS: XSS ok. ?>

<?php if ($product->is_in_stock()) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<?php
		$formClasses = '';
		$quantityInCart = get_product_quantity_in_cart( $product->get_id() );
		if( $quantityInCart > 0 ) {
			$formClasses = ' in-cart';
		}
	?>

	<form class="product__cart<?php echo $formClasses; ?>"
				action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
				method="post" enctype='multipart/form-data'>
		<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<?php do_action('woocommerce_before_add_to_cart_quantity'); ?>

		<?php
		woocommerce_quantity_input(
			array(
				'min_value' => 0,
				'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
				'input_value' => $quantityInCart ?: 1,
			)
		);
		?>

		<?php do_action('woocommerce_after_add_to_cart_quantity'); ?>

		<button class="btn btn--black product__cart-btn" type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>">
			In den Warenkorb
			<svg width="18" height="20"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-cart"></use></svg>
		</button>
		<input type="hidden" name="product_id" value="<?php echo esc_attr($product->get_id()); ?>">

		<?php do_action('woocommerce_after_add_to_cart_button'); ?>
	</form>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php else : ?>

	<div class="product__cart-unavailable">Produkt nicht verfügbar</div>

<?php endif; ?>
