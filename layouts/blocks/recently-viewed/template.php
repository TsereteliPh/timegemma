<?php if ( ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ) : ?>
	<section class="recently-viewed">
		<div class="container recently-viewed__container main-slider swiper">
			<div class="title title--dark recently-viewed__title">
				<svg width="74" height="87"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial-half"></use></svg>
				<h2 class="title__text">Zuletzt angesehen</h2>
			</div>

			<ul class="reset-list recently-viewed__list swiper-wrapper">
				<?php
					$products = explode( '|', $_COOKIE['woocommerce_recently_viewed'] );

					$args = array(
						'post_type' => 'product',
						'post__in' => $products,
						'orderby' => 'post__in'
					);

					$query = new WP_Query( $args );
					$posts = $query->posts;

					if ( $query->have_posts() ) {
						if (is_archive()) {
							foreach ($posts as $post) {
								get_template_part('/layouts/partials/cards/product-card', null, array(
									'class' => 'no-background recently-viewed__item swiper-slide',
								) );
							}
						} else {
							while ( $query->have_posts() ) {
								$query->the_post();

								get_template_part('/layouts/partials/cards/product-card', null, array(
									'class' => 'no-background recently-viewed__item swiper-slide',
								) );
							}

							wp_reset_postdata();
						}
					}
				?>
			</ul>

			<div class="slider-controls recently-viewed__controls">
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
<?php endif; ?>
