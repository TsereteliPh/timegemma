<section class="favorites">
	<div class="container favorites__container">
		<div class="title title--dark collections__title">
			<svg width="74" height="87"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial-half"></use></svg>
			<h1 class="title__text">Favoriten</h1>
		</div>

		<?php
			$user_favorites = get_user_meta( get_current_user_id(), 'favorites', false );
			$user_favorites =  json_decode( $user_favorites[0], true );

			if ( $user_favorites ) :
		?>
			<ul class="reset-list catalog__list favorites__list">
				<?php
					$args = array(
						'post_type' => 'product',
						'post__in' => $user_favorites,
						'orderby' => 'post__in'
					);

					$query = new WP_Query( $args );
					$posts = $query->posts;

					if ( $query->have_posts() ) {
						if (is_archive()) {
							foreach ($posts as $post) {
								get_template_part('/layouts/partials/cards/product-card', null, array(
									'class' => 'favorites__item',
								) );
							}
						} else {
							while ( $query->have_posts() ) {
								$query->the_post();

								get_template_part('/layouts/partials/cards/product-card', null, array(
									'class' => 'favorites__item',
								) );
							}

							wp_reset_postdata();
						}
					}
				?>
			</ul>
		<?php else : ?>
			<div class="favorites__empty">
				<div class="favorites__text">Es sind keine vorgestellten Produkte vorhanden</div>

				<a class="btn btn--black favorites__link" href="<?php echo wc_get_page_permalink( 'shop' ); ?>">Katalog</a>
			</div>
		<?php endif; ?>
	</div>
</section>
