<?php
	global $product;

	$yearTerm = get_the_terms( $product->get_id(), 'pa_construction-year' );
	$flash = false;
	if ( get_field( 'product_new' ) ) $flash = 'product-card__wrapper--new';
	if ( $yearTerm ) $flash = 'product-card__wrapper--year';

	$thumbnail = get_the_post_thumbnail_url( $product->get_id(), 'full' );
?>
<li <?php wc_product_class( 'product-card ' . $args['class'], $product ); ?>>
	<div class="product-card__wrapper <?php echo $flash ? $flash : ''; ?>" <?php echo $yearTerm ? 'data-year="' . $yearTerm[0]->name . '"' : ''; ?>>
		<?php if ( is_user_logged_in() ) : ?>
			<button class="btn-fav product-card__fav<?php echo adem_check_favorite( $product->get_id() ) ? ' active' : ''; ?>" type="button" data-id="<?php echo $product->get_id(); ?>" data-user="<?php echo get_current_user_id(); ?>">
				<svg width="22" height="20"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-heart"></use></svg>
			</button>
		<?php endif; ?>

		<div class="product-card__img">
			<?php
				if ( $thumbnail ) {
					the_post_thumbnail( '180x300' );
				} else {
					echo wp_get_attachment_image( 86, '180x300', false );
				}
			?>
		</div>

		<a href="<?php the_permalink(); ?>" class="product-card__link"><?php the_title(); ?></a>

		<div class="product-card__price"><?php echo $product->get_price_html(); ?></div>
	</div>
</li>
