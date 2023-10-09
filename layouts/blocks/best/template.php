<?php $bgColor = get_sub_field( 'bg_color' ); ?>
<section class="haze best<?php echo ($bgColor) ? ' best--' . $bgColor : ''; ?>">
	<div class="container best__container main-slider swiper">
		<?php
			get_template_part('/layouts/partials/title', null, array(
				'class' => 'best__title',
				'title' => get_sub_field('title')
			));

			$bestProducts = get_sub_field('best_products');
			if ( $bestProducts ) :
		?>
			<ul class="reset-list best__list swiper-wrapper">
				<?php
					foreach ( $bestProducts as $post ) :
                        setup_postdata( $post );
				?>
					<?php get_template_part('/layouts/partials/cards/product-card', null, array(
						'class' => 'best__item swiper-slide',
					) ); ?>
				<?php
						wp_reset_postdata();
					endforeach;
				?>
			</ul>

			<div class="slider-controls best__controls">
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
