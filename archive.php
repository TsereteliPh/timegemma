<?php get_header(); ?>

<section class="news">
	<div class="container news__container">
		<div class="title title--dark news__title">
			<svg width="74" height="87"><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/images/sprite.svg#icon-dial-half"></use></svg>
			<h1 class="title__text">Nachricht</h1>
		</div>

		<ul class="reset-list news__list js-show-more-container">
			<?php
				$args = [
					'post_type' => 'post',
					'cat' => 42,
					'orderby' => 'post_date',
					'posts_per_page' => '6',
					'paged' => 1
				];

				$query = new WP_Query($args);
				$posts = $query->posts;

				if ( $query->have_posts() ) {
                    if (is_archive()) {
                        foreach ($posts as $post) {
                            get_template_part('layouts/partials/cards/news-card', null, array(
								'class' => 'news__item'
                            ));
                        }
                    } else {
                        while ( $query->have_posts() ) {
                            $query->the_post();

                            get_template_part('layouts/partials/cards/news-card', null, array(
								'class' => 'news__item'
                            ));
                        }

                        wp_reset_postdata();
                    }
				}
			?>
		</ul>

		<?php if ( $query->max_num_pages > 1) : ?>
			<button class="btn btn--dark news__button js-show-more" type="button">Mehr laden</button>

			<script>
				let posts = '<?php echo json_encode($query->query_vars); ?>';
				let current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
				let max_pages = <?php echo $query->max_num_pages; ?>;
			</script>
		<?php endif; ?>
	</div>
</section>

<?php
	$term = get_queried_object();
	$categoryID = get_cat_ID($term->name);
	$acfPostID = 'category_' . $categoryID;
	get_template_part('layouts/partials/blocks', null, array(
		'id' => $acfPostID
	));
?>

<?php get_footer(); ?>
