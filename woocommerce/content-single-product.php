<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<section id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="container">
		<div class="product__info">
			<div class="product__desc">
				<?php
				// echo '<pre>';
				// print_r( $product );
				// echo '</pre>';
				?>

				<?php
					$terms = get_the_terms( $product->get_id(), 'product_cat' );
					if ( $terms ) :
				?>
					<div class="product__cat">
						<?php foreach ( $terms as $term ) : ?>
							<a href="<?php echo esc_url( get_term_link( $term->term_id, 'product_cat' ) ); ?>" class="product__cat-link" aria-label="Link zu Produkten in der Kategorie <?php echo $term->name; ?>">
								<?php
									$term_thumb = get_term_meta( $term->term_id, 'thumbnail_id', true );
									echo wp_get_attachment_image( $term_thumb, 'medium', false );
								?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<h1 class="product__title"><?php echo $product->name; ?></h1>

				<div class="product__desc-text"><?php the_field( 'description' ); ?></div>

				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * //@hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>

			<div class="product__panel">
				<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
		 		 * //@hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * //@hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>
		</div>

		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		//do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>
</section>

<?php do_action( 'woocommerce_after_single_product' ); ?>