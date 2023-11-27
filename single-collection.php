<?php get_header(); ?>

<section class="single-collection">
	<div class="container single-collection__container">
		<div class="title title--dark single-collection__title">
			<svg width="74" height="87"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial-half"></use></svg>
			<h1 class="title__text"><?php the_title(); ?></h1>
		</div>

		<?php
			$terms = get_field( 'collection_brand' );
			if ( $terms ) :
		?>
			<div class="single-collection__brands">
				<?php foreach ( $terms as $term ) : ?>
					<a href="<?php echo esc_url( get_term_link( $term->term_id, 'product_cat' ) ); ?>" class="single-collection__link">
						<?php
							$term_thumb = get_term_meta( $term->term_id, 'thumbnail_id', true );

							if ( $term_thumb ) {
								echo wp_get_attachment_image( $term_thumb, 'medium', false );
							} else {
								echo '<span>' . $term->name . '</span>';
							}
						?>
					</a>

					<div class="single-collection__separator"></div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php
			$products = get_field( 'collection_products' );
			if ( $products ) :
		?>
			<ul class="reset-list catalog__list single-collection__list">
				<?php
					foreach ($products as $post) {
						setup_postdata( $post );

						get_template_part('/layouts/partials/cards/product-card', null, array(
							'class' => 'catalog__item',
						) );

						wp_reset_postdata();
					}
				?>
			</ul>
		<?php endif; ?>
	</div>
</section>

<?php get_template_part('layouts/partials/blocks', null, array(
	'id' => $acfPostID
)); ?>

<?php get_footer(); ?>
