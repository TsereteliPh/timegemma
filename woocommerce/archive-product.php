<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * //@hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * //@hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<section class="catalog">
	<?php
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * //@hooked woocommerce_taxonomy_archive_description - 10
		 * //@hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
	?>

	<div class="catalog__cats">
		<div class="container">
			<?php
				$currentTerm = get_queried_object();
			?>
		</div>

		<div class="container">
			<?php
				$currentTerm = get_queried_object();
				$forHimAncestor = $currentTerm->term_id == 17 || term_is_ancestor_of( 17, $currentTerm->term_id, 'product_cat' );
				$forHerAncestor = $currentTerm->term_id == 18 || term_is_ancestor_of( 18, $currentTerm->term_id, 'product_cat' );

				$termList = get_terms( [
					'taxonomy' => 'product_cat',
					'child_of' => ( $forHimAncestor ) ? 17 : 18
				] );
			?>

			<div class="reset-list catalog__cats-list">
				<a <?php echo ( !$forHimAncestor || is_shop() ) ? 'href="' . get_term_link( 17 ) . '"' : ''; ?> class="catalog__cats-item<?php echo ( $forHimAncestor ) ? ' active' : ''; ?>">Für Männer</a>
				<a <?php echo ( !$forHerAncestor || is_shop() ) ? 'href="' . get_term_link( 18 ) . '"' : ''; ?> class="catalog__cats-item<?php echo ( $forHerAncestor ) ? ' active' : ''; ?>">Für Frauen</a>
			</div>

			<?php if ( $termList && !is_shop() ) : ?>
				<div class="catalog__cats-wrapper">
					<?php foreach ( $termList as $term ) : ?>
						<a href="<?php echo get_term_link( $term->term_id ); ?>" class="catalog__cats-cat<?php echo ( $term->term_id == $currentTerm->term_id) ? ' active' : ''; ?>">
							<?php
								$termThumb = get_term_meta( $term->term_id, 'thumbnail_id', true );

								if ( $termThumb ) {
									echo wp_get_attachment_image( $termThumb, 'medium', false );
								} else {
									echo '<span>' . $term->name . '</span>';
								}
							?>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="catalog__products">
		<div class="container catalog__container">
			<?php
				if ( woocommerce_product_loop() ) {

					/**
					 * Hook: woocommerce_before_shop_loop.
					 *
					 * //@hooked woocommerce_output_all_notices - 10
					 * //@hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );

					woocommerce_product_loop_start();

					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 */
							do_action( 'woocommerce_shop_loop' );

							// wc_get_template_part( 'content', 'product' );
							get_template_part('/layouts/partials/cards/product-card', null, array(
								'class' => 'catalog__item',
							) );
						}
					}

					woocommerce_product_loop_end();

					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * //@hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );
				}

				/**
				 * Hook: woocommerce_after_main_content.
				 *
				 * //@hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );

				/**
				 * Hook: woocommerce_sidebar.
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action( 'woocommerce_sidebar' );
			?>
		</div>
	</div>
</section>

<?php get_template_part('layouts/partials/blocks', null, array(
	'id' => 10
)); ?>

<?php get_footer( 'shop' ); ?>
