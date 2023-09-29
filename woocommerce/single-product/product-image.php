<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

	defined( 'ABSPATH' ) || exit;

	// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
	if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
		return;
	}

	global $product;

	$gallery = $product->get_gallery_image_ids();
?>

<?php do_action( 'woocommerce_product_thumbnails' ); ?>
<div class="product__gallery swiper">
	<div class="product__gallery-wrapper swiper-wrapper">
		<?php foreach ( $gallery as $img ) : ?>
			<a href="<?php echo wp_get_attachment_image_url( $img, 'full', false ); ?>" class="product__gallery-link" data-fancybox="product-gallery">
				<?php echo wp_get_attachment_image( $img, 'large', false, array(
					'class' => 'product__gallery-image'
				) ); ?>
			</a>
        <?php endforeach; ?>
	</div>

	<div class="slider-controls welcome__controls">
		<div class="btn-arrow slider-controls__prev">
			<svg width="70" height="8"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-left"></use></svg>
		</div>

		<div class="slider-controls__progressbar">
			<svg class="slider-controls__dial" width="60" height="60"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial"></use></svg>
			<svg class="slider-controls__fraction" width="60" height="60"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial"></use></svg>
			<div class="slider-controls__counter"></div>
		</div>

		<div class="btn-arrow slider-controls__next">
			<svg width="70" height="8"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-right"></use></svg>
		</div>
	</div>
</div>
