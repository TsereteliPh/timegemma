<section class="new-releases">
	<div class="container new-releases__container">
		<div class="new-releases__panel">
			<h2 class="new-releases__title" data-year="<?php echo date( 'Y' ); ?>"><?php the_sub_field( 'title' ); ?></h2>

			<ul class="reset-list new-releases__btns js-tabs">
				<li class="btn-tab new-releases__btn active" data-tab="new-releases__item" data-class="new-for-him">Für ihn</li>
				<li class="btn-tab new-releases__btn" data-tab="new-releases__item" data-class="new-for-her">Für Sie</li>
			</ul>
		</div>

		<?php
			$for_him = get_sub_field( 'for_him' );
			$for_her = get_sub_field( 'for_her' );
			if ( $for_him || $for_her ) :
		?>
			<div class="new-releases__slider swiper">
				<ul class="reset-list new-releases__list swiper-wrapper">
					<?php
						foreach ( $for_him as $post ) {
							setup_postdata( $post );

							get_template_part('/layouts/partials/cards/product-card', null, array(
								'class' => 'new-releases__item new-for-him swiper-slide active',
							) );

							wp_reset_postdata();
						}

						foreach ( $for_her as $post ) {
							setup_postdata( $post );

							get_template_part('/layouts/partials/cards/product-card', null, array(
								'class' => 'new-releases__item new-for-her swiper-slide',
							) );

							wp_reset_postdata();
						}
					?>
				</ul>
			</div>

			<div class="slider-controls new-releases__controls">
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
		<?php endif; ?>
	</div>
</section>
