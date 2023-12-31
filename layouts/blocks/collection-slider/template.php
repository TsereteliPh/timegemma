<?php
	$sorted = get_sub_field( 'sorted' );
	$collections = get_sub_field( 'collections' );
	if ( $sorted ) $collections = get_sub_field( 'sorted-collections' );
?>
<section class="collection-slider<?php echo ( $sorted ) ? ' collection-slider--sorted' : ''; ?>">
	<div class="container collection-slider__container">
		<?php if ( !$sorted ) : ?>
			<h2 class="collection-slider__title"><?php the_sub_field( 'title' ); ?></h2>
		<?php endif; ?>

		<div class="collection-slider__slider swiper">
			<ul class="reset-list collection-slider__list swiper-wrapper">
				<?php
					if ( !$sorted ) {
						$query = new WP_Query( array(
							'post_type'         => 'collection',
							'posts_per_page'    => -1,
							'post__in'          => $collections,
							'post_status'       => 'any',
							'orderby'           => 'post__in',
						) );
						$posts = $query->posts;

						if ( $query->have_posts() ) {
							if (is_archive()) {
								foreach ($posts as $post) {
									echo '<li class="collection-slider__item swiper-slide">';
										get_template_part('/layouts/partials/cards/collection-card', null, array(
											'class' => 'collection-slider__link',
										) );
									echo '</li>';
								}
							} else {
								while ( $query->have_posts() ) {
									$query->the_post();

									echo '<li class="collection-slider__item swiper-slide">';
										get_template_part('/layouts/partials/cards/collection-card', null, array(
											'class' => 'collection-slider__link',
										) );
									echo '</li>';
								}

								wp_reset_postdata();
							}
						}
					} else {
						$iteration = 0;

						foreach ( $collections as $collection ) {
							$query = new WP_Query( array(
								'post_type'         => 'collection',
								'posts_per_page'    => -1,
								'post__in'          => $collection['items'],
								'post_status'       => 'any',
								'orderby'           => 'post__in',
							) );
							$posts = $query->posts;

							if ( $query->have_posts() ) {
								$extraClass = ' year_' . $collection['year'];
								if ( $iteration == 0 ) $extraClass .= ' active';

								if (is_archive()) {
									foreach ($posts as $post) {
										echo '<li class="collection-slider__item swiper-slide' . $extraClass . '">';
											get_template_part('/layouts/partials/cards/collection-card', null, array(
												'class' => 'collection-slider__link',
											) );
										echo '</li>';
									}
								} else {
									while ( $query->have_posts() ) {
										$query->the_post();

										echo '<li class="collection-slider__item swiper-slide' . $extraClass . '">';
											get_template_part('/layouts/partials/cards/collection-card', null, array(
												'class' => 'collection-slider__link',
											) );
										echo '</li>';
									}

									wp_reset_postdata();
								}
							}

							$iteration++;
						}
					}
				?>
			</ul>
		</div>

		<div class="slider-controls collection-slider__controls">
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

		<?php if ( $sorted ) : ?>
			<div class="collection-slider__panel">
				<h2 class="collection-slider__title"><?php the_sub_field( 'title' ); ?></h2>

				<ul class="reset-list collection-slider__btns js-tabs">
					<?php foreach ( $collections as $key => $collection ) : ?>
						<li class="btn-tab collection-slider__btn<?php echo ($key == 0) ? ' active' : ''; ?>" data-tab="collection-slider__item" data-class="<?php echo 'year_' . $collection['year']; ?>"><?php echo $collection['year']; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>
</section>
