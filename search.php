<?php get_header(); ?>

<section class="search">
	<div class="container search__container">
		<?php if ( have_posts() ) : ?>
			<h1 class="search__title">
				Suchergebnisse für die Suchanfrage:
				<span>&#171;<?php the_search_query(); ?>&#187;</span>
			</h1>

			<?php
				$products = [];
				$news = [];
				$collections = [];

				foreach ( $posts as $post ) {
					if ( $post->post_type == 'product' ) {
						$products[] = $post;
					} else if ( $post->post_type == 'collection' ) {
						$collections[] = $post;
					} else if ( $post->post_type == 'post' ) {
						$news[] = $post;
					}
				}
			?>

			<?php if ( $products ) : ?>
				<div class="search__catalog">
					<div class="title title--dark search__group-title">
						<svg width="74" height="87"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial-half"></use></svg>
						<h2 class="title__text">
							Waren:
							<span><?php echo count( $products ); ?></span>
						</h2>
					</div>

					<ul class="reset-list catalog__list">
						<?php
							foreach ( $products as $post ) {
								setup_postdata( $post );

								get_template_part('/layouts/partials/cards/product-card', null, array(
									'class' => 'catalog__item',
								) );

								wp_reset_postdata();
							}
						?>
					</ul>
				</div>
			<?php endif; ?>

			<?php if ( $news ) : ?>
				<div class="search__news">
					<div class="title title--dark search__group-title">
						<svg width="74" height="87"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial-half"></use></svg>
						<h2 class="title__text">
							Nachricht:
							<span><?php echo count( $news ); ?></span>
						</h2>
					</div>

					<ul class="reset-list news__list">
						<?php
							foreach ( $news as $post ) {
								setup_postdata( $post );

								get_template_part('layouts/partials/cards/news-card', null, array(
									'class' => 'news__item'
								));

								wp_reset_postdata();
							}
						?>
					</ul>
				</div>
			<?php endif; ?>

			<?php if ( $collections ) : ?>
				<div class="search__collections">
					<div class="title title--dark search__group-title">
						<svg width="74" height="87"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial-half"></use></svg>
						<h2 class="title__text">
							Sammlungen:
							<span><?php echo count( $collections ); ?></span>
						</h2>
					</div>

					<div class="collections__wrapper">
						<?php
							foreach ( $collections as $post ) {
								setup_postdata( $post );

								get_template_part('/layouts/partials/cards/collection-card', null, array(
									'class' => 'collections__link',
								) );

								wp_reset_postdata();
							}
						?>
					</div>
				</div>
			<?php endif; ?>

		<?php else : ?>
			<h1 class="search__title">Für Ihre Anfrage wurden keine Ergebnisse gefunden</h1>

			<a href="<?php echo bloginfo( 'url' ); ?>" class="btn btn--dark btn--dial search__link">
				Zur Hauptsache
				<div class="btn__dial">
					<svg width="83" height="76"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-dial"></use></svg>
				</div>
			</a>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
