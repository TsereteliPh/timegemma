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
 * //@hooked woocommerce_output_all_notices - 10
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
				// print_r( $product->attributes );
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
				 * //@hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );
				?>

				<div class="product__tax">inkl. 19% USt. , zzgl. Versand</div>

				<?php
					$retail_price = get_field( 'retail_price' );
					$benefit = $product->get_price() - $retail_price;
					$benefit_percent = round(($benefit / $product->get_price() * 100), 2);
					if ( $retail_price ) : ?>
						<div class="product__retail-price">
							Unverbindliche Preisempfehlung des<br>
							Herstellers: <?php echo number_format( $retail_price, 0, ',', '.' ); ?> €
						</div>

						<div class="product__benefit">(Sie sparen <?php echo number_format( $benefit_percent, 2, ',', '.' ); ?>%, also <?php echo number_format( $benefit, 0, ',', '.' ); ?> €)</div>
				<?php endif; ?>
			</div>
		</div>

		<ul class="reset-list product__list">
			<?php
				$attributes = $product->get_attributes();
				if ( $attributes ) :
			?>
				<li class="product__item product__item--desc">
					<button class="product__item-button">
						Beschreibung

						<div class="product__item-cross">
							<svg width="75" height="75"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial"></use></svg>
						</div>
					</button>

					<ul class="reset-list product__item-attributes">
						<?php
							foreach ( $attributes as $attribute ) :
								if ( $attribute->is_taxonomy() ) :
									$attribute_taxonomy = $attribute->get_taxonomy_object();
									$attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );
						?>
							<li class="product__item-attribute">
								<?php echo $attribute_taxonomy->attribute_label; ?>

								<span>
									<?php
										foreach ( $attribute_values as $key => $value ) {
											if ( count( $attribute_values ) != $key + 1 ) {
												echo $value->name . ', ';
											} else {
												echo $value->name;
											}
										}
									?>
								</span>
							</li>
						<?php
							else :
							$values = $attribute->get_options();
						?>
							<li class="product__item-attribute">
								<?php echo $attribute['name']; ?>

								<span>
									<?php
										foreach ( $attribute['options'] as $key => $value ) {
											if ( count( $attribute['options'] ) != $key + 1 ) {
												echo $value . ', ';
											} else {
												echo $value;
											}
										}
									?>
								</span>
							</li>
						<?php
								endif;
							endforeach;
						?>
					</ul>
				</li>
			<?php endif; ?>
		</div>

		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * //@hooked woocommerce_output_product_data_tabs - 10
		 * //@hooked woocommerce_upsell_display - 15
		 * //@hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>
</section>

<?php do_action( 'woocommerce_after_single_product' ); ?>
