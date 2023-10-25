<section class="last-news">
	<div class="container last-news__container">
        <?php get_template_part('/layouts/partials/title', null, array(
            'class' => 'title--dark last-news__title',
            'title' => get_sub_field('title')
        )); ?>

		<ul class="reset-list last-news__list">
			<?php
				$args = [
					'post_type' => 'post',
					'cat' => 42,
					'orderby' => 'post_date',
					'posts_per_page' => '4',
					'paged' => 1
				];

				$query = new WP_Query($args);
				$archiveLink = get_post_type_archive_link( $query->post_type );
				$posts = $query->posts;

				if ( $query->have_posts() ) {
                    if (is_archive()) {
                        foreach ($posts as $post) {
                            get_template_part('layouts/partials/cards/news-card', null, array(
								'class' => 'news__item last-news__item'
                            ));
                        }
                    } else {
                        while ( $query->have_posts() ) {
                            $query->the_post();

                            get_template_part('layouts/partials/cards/news-card', null, array(
								'class' => 'news__item last-news__item'
                            ));
                        }

                        wp_reset_postdata();
                    }
				}
			?>
		</ul>

		<a href="<?php echo bloginfo( 'url' ) . '/news' ?>" class="btn btn--dark btn--dial last-news__link">
			Alle Nachrichten
			<div class="btn__dial">
				<svg width="83" height="76"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-arrow-dial"></use></svg>
			</div>
		</a>
	</div>
</section>
