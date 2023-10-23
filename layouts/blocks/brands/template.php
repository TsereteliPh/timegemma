<section class="brands">
	<div class="container">
		<?php
			get_template_part('/layouts/partials/title', null, array(
				'class' => 'title--dark brands__title',
				'title' => get_sub_field('title')
			));

			$terms = get_terms( [
				'taxonomy' => 'product_cat',
				'exclude' => array(
					15,17,18
				)
			] );
			if ( $terms ) :
		?>
			<div class="brands__slider swiper">
				<ul class="reset-list brands__list swiper-wrapper">
					<?php foreach ( $terms as $term ) : ?>
						<li class="brands__item swiper-slide">
							<a href="<?php echo get_term_link( $term->term_id ); ?>" class="brands__link" aria-label="<?php echo $term->name; ?>">
								<svg width="195" height="195"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial-square"></use></svg>

								<?php
									$termThumb = get_term_meta( $term->term_id, 'thumbnail_id', true );

									if ( $termThumb ) {
										echo wp_get_attachment_image( $termThumb, 'medium', false );
									} else {
										echo '<span>' . $term->name . '</span>';
									}
								?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<div class="slider-controls brands__controls">
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
</section>
